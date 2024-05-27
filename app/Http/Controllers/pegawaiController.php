<?php

namespace App\Http\Controllers;

use App\Models\pangkat;
use App\Models\pegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;

class pegawaiController extends Controller
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
        $limit = $request->input('limit', 10);
        $jumlahbaris = 10;
        if(strlen($katakunci)){
            $data = pegawai::join('pangkat', 'pangkat.id_pangkat', '=', 'pegawai.id_pangkat')
                ->where('nama_pegawai', 'like', "%$katakunci%")
                ->orWhere('pangkat.nama_pangkat', 'like', "%$katakunci%")
                ->orWhere('jabatan','like',"%$katakunci%")
                ->orWhere('status','like',"%$katakunci%")
                ->orWhere('nip','like',"%$katakunci%")
                ->orWhere('nrp','like',"%$katakunci%")
                ->orWhere('alamat','like',"%$katakunci%")
                ->orWhere('no_telp','like',"%$katakunci%")
                ->paginate($jumlahbaris);
        } else {
            $data = pegawai::join('pangkat','pangkat.id_pangkat','=','pegawai.id_pangkat')
            ->orderBy('nama_pegawai', 'asc')->paginate($jumlahbaris);
        }

        return view ('pegawai.index')->with('data', $data);
        
        // paginate() untuk menampilkan data ga semua nya dibagi gitu
        // $data = contoh::orderBy('nim', 'desc')->paginate(1);
    }

    // public function detail($id){
    //     $data = pegawai::where('id', $id)->first();
    //     return view('pegawai.show')->with('data', $data);
    // }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //mengirimkan data
        $data['pangkat']=pangkat::all();
        return view ('pegawai.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Session::flash('nama_pegawai', $request->nama_pegawai);
        Session::flash('id_pangkat', $request->id_pangkat);
        Session::flash('jabatan', $request->jabatan);
        Session::flash('status', $request->status);
        Session::flash('nip', $request->nip);
        Session::flash('nrp', $request->nrp);
        Session::flash('alamat', $request->alamat);
        Session::flash('no_telp', $request->no_telp);
        // Session::flash('foto', $request->foto);

        //contoh itu nama table, dan nim itu nama kolom nya
        $request->validate([ 
            'nama_pegawai' => 'required',
            'id_pangkat' => 'required',
            'jabatan' => 'required',
            'status' => 'required',
            'nip' => 'required',
            'nrp' => 'required',
            'alamat' => 'required',
            'no_telp' => 'required',
            'foto' => 'mimes:jpeg,jpg,png'
        ], [ 
            'nama_pegawai.required' => 'Nama Pegawai wajib diisi',
            'id_pangkat.required' => 'Pangkat wajib diisi',
            'jabatan.required' => 'Jabatan wajib diisi',
            'status.required' => 'Status wajib diisi',
            'nip.required' => 'NIP wajib diisi',
            'nrp.required' => 'NRP wajib diisi',
            'alamat.required' => 'Alamat wajib diisi',
            'no_telp.required' => 'No Telp wajib diisi',
            'foto.mimes' => 'Foto harus diupload dalam format jpeg, jpg, atau png.'
        ]);

        $foto_file = $request->file('foto');
        $foto_nama = ''; // Deklarasikan variabel dengan nilai default

        // Pastikan file foto ada sebelum melanjutkan
        if ($foto_file) {
            $foto_ekstensi = $foto_file->getClientOriginalExtension(); // Menggunakan getClientOriginalExtension() untuk mendapatkan ekstensi

            $foto_nama = date('ymdhis') . "." . $foto_ekstensi;

            $foto_file->move(public_path('foto_pegawai'), $foto_nama);
        }

        // $foto_file = $request->file('foto');
        // $foto_ektensi = $foto_file->extension();
        // $foto_nama = date('ymdhis').".".$foto_ektensi;
        // $foto_file ->move(public_path('foto_pegawai'),$foto_nama);

        $data = [
            'nama_pegawai' => $request->nama_pegawai,
            'id_pangkat' => $request->id_pangkat,
            'jabatan' => $request->jabatan,
            'status' => $request->status,
            'nip' => $request->nip,
            'nrp' => $request->nrp,
            'alamat' => $request->alamat,
            'no_telp' => $request->no_telp,
            'foto' => $foto_nama,
        ];

        pegawai::create($data);
        return redirect()->to('pegawai')->with('success', 'Berhasil menambahkan data');
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
        
        $data = pegawai::where('id_pegawai', $id)->first();
        $pangkat = pangkat::all(); 
        return view('pegawai.edit')->with('data', $data)->with('pangkat', $pangkat);
        // return view('pegawai.edit')->with('data', $data);
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
            'nama_pegawai' => 'required',
            'id_pangkat' => 'required',
            'jabatan' => 'required',
            'status' => 'required',
            'nip' => 'required',
            'nrp' => 'required',
            'alamat' => 'required',
            'no_telp' => 'required',
        ], [ 
            'nama_pegawai.required' => 'Nama Pegawai wajib diisi',
            'id_pangkat.required' => 'Pangkat wajib diisi',
            'jabatan.required' => 'Jabatan wajib diisi',
            'status.required' => 'Status wajib diisi',
            'nip.required' => 'NIP wajib diisi',
            'nrp.required' => 'NRP wajib diisi',
            'alamat.required' => 'Alamat wajib diisi',
            'no_telp.required' => 'No Telp wajib diisi',
        ]);

        $data = [
            'nama_pegawai' => $request->nama_pegawai,
            'id_pangkat' => $request->id_pangkat,
            'jabatan' => $request->jabatan,
            'status' => $request->status,
            'nip' => $request->nip,
            'nrp' => $request->nrp,
            'alamat' => $request->alamat,
            'no_telp' => $request->no_telp,
            // 'foto' => $request->foto,
        ];

        if($request->hasFile('foto')){
            $request->validate([
                'foto' => 'mimes:jpeg,jpg,png'
            ], [
                'foto.mimes' => 'Foto harus diupload dalam format jpeg, jpg, atau png.'
            ]);
            $foto_file = $request->file('foto');
            $foto_ektensi = $foto_file->extension();
            $foto_nama = date('ymdhis').".".$foto_ektensi;
            $foto_file ->move(public_path('foto_pegawai'),$foto_nama);

            //menghapus foto yang lama dalam melakukan update foto
            $data_foto = pegawai::where('id_pegawai', $id)->first();
            File::delete(public_path('foto_pegawai').'/'.$data_foto->foto);

            $data ['foto'] = $foto_nama;
        }

        $data['id_pangkat'] = $request->id_pangkat;
    
        pegawai::where('id_pegawai',$id)->update($data);
        return redirect()->to('pegawai')->with('success', 'Berhasil melakukan update data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //untuk menghapus foto yang ada di folder public
        $data = pegawai::where('id_pegawai', $id)->first();
        File::delete(public_path('foto_pegawai'). '/'. $data->foto);

        pegawai::where('id_pegawai', $id)->delete();
        return redirect()->to('pegawai')->with('success', 'Berhasil melakukan delete data');
    }
}
