<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Gate;
use \Mpdf\Mpdf;

use App\Models\pegawai;
use App\Models\terdakwa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Barryvdh\DomPDF\Facade as PDF;
use Barryvdh\DomPDF\PDF as DomPDFPDF;

class papankontrolController extends Controller
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
            $data = terdakwa::leftJoin('pegawai as jaksa1_pegawai', 'jaksa1_pegawai.id_pegawai', '=', 'terdakwa.jaksa1')
                ->leftJoin('pegawai as jaksa2_pegawai', 'jaksa2_pegawai.id_pegawai', '=', 'terdakwa.jaksa2')
                ->leftJoin('pegawai as petugas_bb_pegawai', 'petugas_bb_pegawai.id_pegawai', '=', 'terdakwa.petugas_bb')
                ->select(
                    'terdakwa.*',
                    'jaksa1_pegawai.nama_pegawai as jaksa1_nama',
                    'jaksa2_pegawai.nama_pegawai as jaksa2_nama',
                    'petugas_bb_pegawai.nama_pegawai as petugas_bb_nama'
                )  
                ->where(function($query) use ($katakunci) {
                    $query->where('nama_terdakwa','like',"%$katakunci%")
                        ->orWhere('tempat_lahir','like',"%$katakunci%")
                        ->orWhere('tgl_lahir','like',"%$katakunci%")
                        ->orWhere('umur','like',"%$katakunci%")
                        ->orWhere('jenis_kelamin','like',"%$katakunci%")
                        ->orWhere('kebangsaan','like',"%$katakunci%")
                        ->orWhere('agama','like',"%$katakunci%")
                        ->orWhere('alamat_terdakwa','like',"%$katakunci%")
                        ->orWhere('pekerjaan','like',"%$katakunci%")
                        ->orWhere('reg_perkara','like',"%$katakunci%")
                        ->orWhere('reg_bukti','like',"%$katakunci%")
                        ->orWhere('tgl_penyitaan','like',"%$katakunci%")
                        ->orWhere('tgl_penerimaan_bb','like',"%$katakunci%")
                        ->orWhere('pasal','like',"%$katakunci%")
                        ->orWhere('jaksa1_pegawai.nama_pegawai','like',"%$katakunci%")
                        ->orWhere('jaksa2_pegawai.nama_pegawai','like',"%$katakunci%")
                        ->orWhere('nama_penyidik','like',"%$katakunci%")
                        ->orWhere('pangkat_nrp_penyidik','like',"%$katakunci%")
                        ->orWhere('print_p48','like',"%$katakunci%")
                        ->orWhere('tgl_p48','like',"%$katakunci%")
                        ->orWhere('no_putusan','like',"%$katakunci%")
                        ->orWhere('tgl_putusan','like',"%$katakunci%")
                        ->orWhere('barang_bukti','like',"%$katakunci%")
                        ->orWhere('status_barang_bukti','like',"%$katakunci%")
                        ->orWhere('status_eksekusi','like',"%$katakunci%")
                        ->orWhere('keterangan_eksekusi','like',"%$katakunci%")
                        ->orWhere('keterangan_putusan','like',"%$katakunci%")
                        ->orWhere('petugas_bb_pegawai.nama_pegawai','like',"%$katakunci%")
                        ->orWhere('putusan_penahanan','like',"%$katakunci%");
                })->where('status_barang_bukti', '<>', 'inkrah')
                ->paginate($jumlahbaris);
        } else {
            $data = terdakwa::leftJoin('pegawai as jaksa1_pegawai', 'jaksa1_pegawai.id_pegawai', '=', 'terdakwa.jaksa1')
                ->leftJoin('pegawai as jaksa2_pegawai', 'jaksa2_pegawai.id_pegawai', '=', 'terdakwa.jaksa2')
                ->leftJoin('pegawai as petugas_bb_pegawai', 'petugas_bb_pegawai.id_pegawai', '=', 'terdakwa.petugas_bb')
                ->select(
                    'terdakwa.*',
                    'jaksa1_pegawai.nama_pegawai as jaksa1_nama',
                    'jaksa2_pegawai.nama_pegawai as jaksa2_nama',
                    'petugas_bb_pegawai.nama_pegawai as petugas_bb_nama'
                )->where('status_barang_bukti', '<>', 'inkrah')    
            ->orderBy('status_barang_bukti', 'asc')->paginate($jumlahbaris);
        }
        return view ('papankontrol.index')->with('data', $data);
        
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
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
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
        $datapegawai = pegawai::where('status', 'jaksa')->get();
        $databb = pegawai::where('status', 'tata usaha')->get();
        $data = terdakwa::where('id_terdakwa', $id)->first();
        return view('terdakwa.edit')->with('data', $data)->with('datapegawai', $datapegawai)->with('databb', $databb);
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
        $request->validate([ 
            'nama_terdakwa' => 'required',
            'tempat_lahir' => 'required',
            'tgl_lahir' => 'required',
            'umur' => 'required',
            'jenis_kelamin' => 'required',
            'kebangsaan' => 'required',
            'agama' => 'required',
            'alamat_terdakwa' => 'required',
            'pekerjaan' => 'required',
            'reg_perkara' => 'required',
            'reg_bukti' => 'required',
            'tgl_penyitaan' => 'required',
            'tgl_penerimaan_bb' => 'required',
            'pasal' => 'required',
            'jaksa1' => 'required',
            'nama_penyidik' => 'required',
            'pangkat_nrp_penyidik' => 'required',
            'status_barang_bukti' => 'required',
            'status_eksekusi' => 'required'
        ], [ 
            'nama_terdakwa.required' => 'Nama Terdakwa wajib diisi',
            'tempat_lahir.required' => 'Tempat Lahir wajib diisi',
            'tgl_lahir.required' => 'Tanggal Lahir wajib diisi',
            'umur.required' => 'Umur wajib diisi',
            'jenis_kelamin.required' => 'Jenis Kelamin wajib diisi',
            'kebangsaan.required' => 'Kebangsaan wajib diisi',
            'agama.required' => 'Agama wajib diisi',
            'alamat_terdakwa.required' => 'Alamat wajib diisi',
            'pekerjaan.required' => 'Pekerjaan wajib diisi',
            'reg_perkara.required' => 'Reg Perkara wajib diisi',
            'reg_bukti.required' => 'Reg Bukti wajib diisi',
            'tgl_penyitaan.required' => 'Tanggal Penyitaan wajib diisi',
            'tgl_penerimaan_bb.required' => 'Tanggal Penerimaan BB wajib diisi',
            'pasal.required' => 'Pasal wajib diisi',
            'jaksa1.required' => 'Jaksa 1 wajib diisi',
            'nama_penyidik.required' => 'Nama Penyidik wajib diisi',
            'pangkat_nrp_penyidik.required' => 'Pangkat NRP Penyidik wajib diisi',
            'status_barang_bukti.required' => 'Status Barang Bukti wajib diisi',
            'status_eksekusi.required' => 'Status Eksekusi wajib diisi'
        ]);

        $data = [
            'nama_terdakwa' => $request->nama_terdakwa,
            'tempat_lahir' => $request->tempat_lahir,
            'tgl_lahir' => $request->tgl_lahir,
            'umur' => $request->umur,
            'jenis_kelamin' => $request->jenis_kelamin,
            'kebangsaan' => $request->kebangsaan,
            'agama' => $request->agama,
            'alamat_terdakwa' => $request->alamat_terdakwa,
            'pekerjaan' => $request->pekerjaan,
            'reg_perkara' => $request->reg_perkara,
            'reg_bukti' => $request->reg_bukti,
            'tgl_penyitaan' => $request->tgl_penyitaan,
            'tgl_penerimaan_bb' => $request->tgl_penerimaan_bb,
            'pasal' => $request->pasal,
            'jaksa1' => $request->jaksa1,
            'jaksa2' => $request->jaksa2,
            'nama_penyidik' => $request->nama_penyidik,
            'pangkat_nrp_penyidik' => $request->pangkat_nrp_penyidik,
            'print_p48'=> $request->print_p48,
            'tgl_p48' => $request->tgl_p48,
            'no_putusan' => $request->no_putusan,
            'tgl_putusan' => $request->tgl_putusan,
            'barang_bukti' => $request->barang_bukti,
            'status_barang_bukti'=> $request->status_barang_bukti,
            'status_eksekusi' => $request->status_eksekusi,
            'keterangan_eksekusi' => $request->keterangan_eksekusi,
            'keterangan_putusan' => $request->keterangan_putusan,
            'petugas_bb' => $request->petugas_bb,
            'putusan_penahanan' => $request->putusan_penahanan
        ];

        terdakwa::where('id_terdakwa',$id)->update($data);
        return redirect()->to('papankontrol')->with('success', 'Berhasil melakukan update data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        terdakwa::where('id_terdakwa', $id)->delete();
        return redirect()->to('papankontrol')->with('success', 'Berhasil melakukan delete data');
    }
  
}
