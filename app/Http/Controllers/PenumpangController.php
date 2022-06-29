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

    // Fitur Pencarian -----------------------------------------
    public function find(Request $request){
        $request->validate([
            'awal' => 'required',
            'tujuan' => 'required',
            'tanggal_berangkat' => 'required',
            'kelas' => 'required',
            'jumlah' => 'required',
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

        dd($data);
    }

    // Login -----------------------------------------------

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
