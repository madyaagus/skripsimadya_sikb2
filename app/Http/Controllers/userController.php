<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;

class userController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Pencarian data
        // strlen yaitu mengecek apakah ada kata kunci atau tidak
        // or where jika kata kunci nya lebih dari satu jadi ga harus sesuai nim
        // else itu jika 
        // paginate() untuk menampilkan data ga semua nya dibagi gitu
        $katakunci = $request->katakunci;
        $jumlahbaris = 10;
        if(strlen($katakunci)){
            $data = User::where('nip','like',"%$katakunci%")
                ->orWhere('name','like',"%$katakunci%")
                ->orWhere('role','like',"%$katakunci%")
                ->paginate($jumlahbaris);
        } else {
            $data = User::orderBy('name', 'asc')->paginate($jumlahbaris);
        }
        return view ('user.index')->with('data', $data);
        
        // paginate() untuk menampilkan data ga semua nya dibagi gitu
        // $data = contoh::orderBy('nim', 'desc')->paginate(1);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Session::flash('name', $request->name);
        Session::flash('nip', $request->nip);
        Session::flash('password', $request->password);
        Session::flash('role', $request->role);

        // Ambil nilai password dari formulir
        $plainPassword = $request->input('password');

        // Hash password menggunakan bcrypt
        $hashedPassword = Hash::make($plainPassword);

        //contoh itu nama table, dan nim itu nama kolom nya
        $request->validate([ 
            'name' => 'required',
            'nip' => 'required',
            'password' => 'required',
            'role' => 'required',
        ], [ 
            'name.required' => 'Nama wajib diisi',
            'nip.required' => 'NIP wajib diisi',
            'password.required' => 'Password wajib diisi',
            'role.required' => 'Role wajib diisi',
        ]);

        $data = [
            'name' => $request->name,
            'nip' => $request->nip,
            'password' => $hashedPassword,
            'role' => $request->role,
        ];
        User::create($data);
        return redirect()->to('user')->with('success', 'Berhasil menambahkan data');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function edit($id)
    // {
    //     $data = pangkat::where('id_pangkat', $id)->first();
    //     return view('pangkat.edit')->with('data', $data);
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request, $id)
    // {
    //      //contoh itu nama table, dan nim itu nama kolom nya
    //      $request->validate([ 
    //         'nama_pangkat' => 'required',
    //     ], [ 

    //         'nama_pangkat.required' => 'Nama pangkat wajib diisi',
    //     ]);

    //     $data = [
    //         'nama_pangkat' => $request->nama_pangkat,
    //         'keterangan_pangkat' => $request->keterangan_pangkat,
    //     ];
    //     pangkat::where('id_pangkat',$id)->update($data);
    //     return redirect()->to('pangkat')->with('success', 'Berhasil melakukan update data');
    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::where('id', $id)->delete();
        return redirect()->to('user')->with('success', 'Berhasil melakukan delete data');
    }
}
