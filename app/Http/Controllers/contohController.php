<?php

namespace App\Http\Controllers;

use App\Models\contoh;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class contohController extends Controller
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
        $jumlahbaris = 4;
        if(strlen($katakunci)){
            $data = contoh::where('nim','like',"%$katakunci%")
                ->orWhere('nama','like',"%$katakunci%")
                ->orWhere('jurusan','like',"%$katakunci%")
                ->paginate($jumlahbaris);
        } else {
            $data = contoh::orderBy('nim', 'desc')->paginate($jumlahbaris);
        }
        return view ('contoh.index')->with('data', $data);
        
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
        return view ('contoh.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Session::flash('nim', $request->nim);
        Session::flash('nama', $request->nama);
        Session::flash('jurusan', $request->jurusan);

        //contoh itu nama table, dan nim itu nama kolom nya
        $request->validate([ 
            'nim' => 'required|numeric|unique:contoh,nim',
            'nama' => 'required',
            'jurusan' => 'required',
        ], [ 
            'nim.required' => 'NIM wajib diisi',
            'nim.numeric' => 'NIM wajib dalam angka',
            'nim.unique' => 'NIM yang diisikan sudah terdaftar',
            'nama.required' => 'Nama wajib diisi',
            'jurusan.required' => 'Jurusan wajib diisi',
        ]);

        $data = [
            'nim' => $request->nim,
            'nama' => $request->nama,
            'jurusan' => $request->jurusan,
        ];
        contoh::create($data);
        return redirect()->to('contoh')->with('success', 'Berhasil menambahkan data');
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
    public function edit($id)
    {
        $data = contoh::where('nim', $id)->first();
        return view('contoh.edit')->with('data', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
         //contoh itu nama table, dan nim itu nama kolom nya
         $request->validate([ 
            'nama' => 'required',
            'jurusan' => 'required',
        ], [ 

            'nama.required' => 'Nama wajib diisi',
            'jurusan.required' => 'Jurusan wajib diisi',
        ]);

        $data = [
            'nama' => $request->nama,
            'jurusan' => $request->jurusan,
        ];
        contoh::where('nim',$id)->update($data);
        return redirect()->to('contoh')->with('success', 'Berhasil melakukan update data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        contoh::where('nim', $id)->delete();
        return redirect()->to('contoh')->with('success', 'Berhasil melakukan delete data');
    }
}
