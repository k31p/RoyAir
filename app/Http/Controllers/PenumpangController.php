<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Model -------------------------

// Miscs -------------------------
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class PenumpangController extends Controller
{
    // Routes -----------------------------------
    public function login(){
        return view('app.user-login')->with('title', 'Login Page');
    }

    public function searchForm(){
        return view('app.search-tiket')->with('title', 'Cari Tiket');
    }

    public function addPerson(){
        return view('app.add-penumpang')->with('title', 'Data Penumpang');
    }

    // Fitur Pencarian -----------------------------------------
    public function find(Request $request){
        $request->validate([
            'awal' => 'required',
            'tujuan' => 'required',
            'tanggal_berangkat' => 'required',
            'kelas' => 'required',
            'maskapai' => 'required',
        ]);

        $data = DB::table('rute')
        ->join('transportasi as trans', 'trans.id_transportasi', '=', 'rute.id_transportasi')
        ->join('type_transportasi as type', 'type.id_type_transportasi', '=', 'trans.id_type_transportasi')
        ->where('rute.rute_awal', 'LIKE', "$request->awal%")
        ->where('rute.rute_akhir', 'LIKE', "$request->tujuan%")
        ->where('trans.keterangan', '=', $request->maskapai)
        ->where('type.nama_type', '=', $request->kelas)
        ->select(['*', 'trans.keterangan AS kode_pesawat'])
        ->first();

        Session::put('order', $data);
        return redirect()->route('penumpang.cari');
    }

    // Lanjut Isi data Penumpang atau Cancel ------------------------------------------------------
    public function cancelOrder(){
        Session::pull('order');
        return redirect()->route('penumpang.cari');
    }

    public function addPersons(Request $request){
        $request->validate([
            'persons' => 'required',
        ]);

        if (Session::has('persons')) {
            $prev = Session::get('persons');
            Session::put('persons', $prev + $request->persons);
        } else {
            Session::put('persons', $request->persons);
        }

        return redirect()->route('penumpang.add');
    }

    // Booking Pesawat ----------------------------------------------------------------------------
    public function booking(Request $request){
        //dd(Session::get('order'), Session::get('persons'), $request);
        for($x = 1; $x <= Session::get('persons'); $x++){
            $request->validate([
                "person$x" => 'required',
                "no_kursi$x" => 'required',
                "umur$x" => 'required',
            ]);
        }

        include 'Functions.php';
        $rute = Session::get('order');
        $totalBayar = Session::get('persons') * $rute->harga;
        
        for($x = 1; $x <= Session::get('persons'); $x++){
            $kodePemesanan = generateKode('pemesanan', 'PS');
            $kursi = "no_kursi".$x;
            $aksi = DB::table('pemesanan')
            ->insert([
                'kode_pemesanan' => $kodePemesanan, 'tanggal_pemesanan' => now('Asia/Jakarta'), 
                'tempat_pemesanan' => 'online', 'id_pelanggan' => Session::get('penumpangID'), 
                'kode_kursi' => "K".$request->$kursi, 'id_rute' => $rute->id_rute, 'tujuan' => $rute->tujuan, 
                'tanggal_berangkat' => $rute->tanggal_berangkat, 'jam_berangkat' => $rute->jam_berangkat, 
                'total_bayar' => $totalBayar, 'status' => 'Belum Bayar', 
            ]);   
        }

        if ($aksi) {
            Session::pull('order');
            Session::pull('persons');
            return redirect()->route('penumpang.cari');
        } else {
            return back()->with('error');
        }
        
    }

    // Login --------------------------------------------------------------------------------------

    public function cekLogin(Request $request){
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $user = DB::table('penumpang')
                    ->where('username', '=', $request->username)
                    ->first();
        
        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                Session::put('penumpangID', $user->id_penumpang);
                Session::put('penumpangNama', $user->nama_penumpang);
                return redirect('/');
            } else {
                return back()->with('error', true);
            }
            
        } else {
            return back()->with('error', true);
        }
        
    }
}
