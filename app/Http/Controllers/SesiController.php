<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SesiController extends Controller
{
    function index(){
        return view ('login');
    }

    function login(Request $request){
        $request -> validate([ 
            'nip' => 'required',
            'password' => 'required'
        ], [ 
            'nip.required' => 'NIP wajib diisi',
            'password.required' => 'Password wajib diisi'
        ]);

        $infologin = [ 
            'nip' => $request->nip,
            'password' => $request->password,
        ];

        if(Auth::attempt($infologin)){
            if(Auth::user()-> role == 'stafbb'){
                return redirect('/dashboard/stafbb');
            } elseif(Auth::user()-> role == 'kasibb'){
                return redirect('/dashboard/kasibb');
            } elseif(Auth::user()-> role == 'kajari'){
                return redirect('/dashboard/kajari');
            } elseif(Auth::user()-> role == 'jaksa'){
                return redirect('/dashboard/jaksa');
            }
            
        } else {
            return redirect('/login')->withErrors('NIP atau Password Anda salah')->withInput();
        }
    }

    function logout(){
        Auth::logout();
        return redirect('/');
    }
}
