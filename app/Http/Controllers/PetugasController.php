<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Models -----------------------------------------

// Miscs -------------------------------------------
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;

class PetugasController extends Controller
{
    // Routes ----------------------------------------------
    public function login(){
        return view('misc.petugas-login')->with('title', 'Login');
    }

    public function index(){
        return view('misc.petugas-index')->with('title', 'Dashboard');
    }

    // Login -----------------------------------------------

    public function cekLogin(Request $request){
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $user = DB::table('petugas')
                    ->where('username', '=', $request->username)
                    ->first();
        
        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                Session::put('petugasID', $user->id_petugas);
                Session::put('petugasNama', $user->nama_petugas);
                return redirect()->route('petugas.index');
            } else {
                return back()->with('error', true);
            }
            
        } else {
            return back()->with('error', true);
        }
        
    }
}
