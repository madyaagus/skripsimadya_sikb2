<?php

namespace App\Http\Controllers;

use App\Models\pegawai;
use App\Models\terdakwa;
use App\Models\bensus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;

class bensusController extends Controller
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
            $data = bensus::leftJoin('pegawai as jaksa_pegawai', 'jaksa_pegawai.id_pegawai', '=', 'bensus.jaksa')
                ->leftJoin('terdakwa as terdakwa_terdakwa', 'terdakwa_terdakwa.id_terdakwa', '=', 'bensus.terdakwa')
                ->leftJoin('pegawai as bendahara_pegawai', 'bendahara_pegawai.id_pegawai', '=', 'bensus.bendahara')
                ->leftJoin('pegawai as saksi1_pegawai', 'saksi1_pegawai.id_pegawai', '=', 'bensus.saksi1')
                ->leftJoin('pegawai as saksi2_pegawai', 'saksi2_pegawai.id_pegawai', '=', 'bensus.saksi2')
                ->select(
                    'bensus.*',
                    'jaksa_pegawai.nama_pegawai as jaksa_nama',
                    'terdakwa_terdakwa.nama_terdakwa as terdakwa_nama',
                    'bendahara_pegawai.nama_pegawai as bendahara_nama',
                    'saksi1_pegawai.nama_pegawai as saksi1_nama',
                    'saksi2_pegawai.nama_pegawai as saksi2_nama'
                )  
                ->where(function($query) use ($katakunci) {
                    $query->where('hari','like',"%$katakunci%")
                        ->orWhere('tgl_bensus','like',"%$katakunci%")
                        ->orWhere('jaksa_pegawai.nama_pegawai','like',"%$katakunci%")
                        ->orWhere('terdakwa_terdakwa.nama_terdakwa','like',"%$katakunci%")
                        ->orWhere('jumlah_uang','like',"%$katakunci%")
                        ->orWhere('keterangan_uang','like',"%$katakunci%")
                        ->orWhere('bendahara_pegawai.nama_pegawai','like',"%$katakunci%")
                        ->orWhere('tujuan_setoran','like',"%$katakunci%")
                        ->orWhere('bank_setoran','like',"%$katakunci%")
                        ->orWhere('alamat_bank','like',"%$katakunci%")
                        ->orWhere('saksi1_pegawai.nama_pegawai','like',"%$katakunci%")
                        ->orWhere('saksi2_pegawai.nama_pegawai','like',"%$katakunci%")
                        ->orWhere('arsip','like',"%$katakunci%")
                        ->orWhere('status_bensus','like',"%$katakunci%");
                })->paginate($jumlahbaris);
        } else {
            $data = bensus::leftJoin('pegawai as jaksa_pegawai', 'jaksa_pegawai.id_pegawai', '=', 'bensus.jaksa')
                ->leftJoin('terdakwa as terdakwa_terdakwa', 'terdakwa_terdakwa.id_terdakwa', '=', 'bensus.terdakwa')
                ->leftJoin('pegawai as bendahara_pegawai', 'bendahara_pegawai.id_pegawai', '=', 'bensus.bendahara')
                ->leftJoin('pegawai as saksi1_pegawai', 'saksi1_pegawai.id_pegawai', '=', 'bensus.saksi1')
                ->leftJoin('pegawai as saksi2_pegawai', 'saksi2_pegawai.id_pegawai', '=', 'bensus.saksi2')
                ->select(
                    'bensus.*',
                    'jaksa_pegawai.nama_pegawai as jaksa_nama',
                    'terdakwa_terdakwa.nama_terdakwa as terdakwa_nama',
                    'bendahara_pegawai.nama_pegawai as bendahara_nama',
                    'saksi1_pegawai.nama_pegawai as saksi1_nama',
                    'saksi2_pegawai.nama_pegawai as saksi2_nama'
                )  
                ->orderBy('tgl_bensus', 'desc')->paginate($jumlahbaris);
        }
        return view ('bensus.index')->with('data', $data);
        
        // paginate() untuk menampilkan data ga semua nya dibagi gitu
        // $data = contoh::orderBy('nim', 'desc')->paginate(1);
    }

    function view_pdf()
    {
        $mpdf = new \Mpdf\Mpdf();
        $data = bensus::join('pegawai as jaksa_pegawai', 'jaksa_pegawai.id_pegawai', '=', 'bensus.jaksa')
                ->join('terdakwa as terdakwa_terdakwa', 'terdakwa_terdakwa.id_terdakwa', '=', 'bensus.terdakwa')
                ->join('pegawai as bendahara_pegawai', 'bendahara_pegawai.id_pegawai', '=', 'bensus.bendahara')
                ->join('pegawai as saksi1_pegawai', 'saksi1_pegawai.id_pegawai', '=', 'bensus.saksi1')
                ->join('pegawai as saksi2_pegawai', 'saksi2_pegawai.id_pegawai', '=', 'bensus.saksi2')
                ->select(
                    'bensus.*',
                    'jaksa_pegawai.nama_pegawai as jaksa_nama',
                    'terdakwa_terdakwa.nama_terdakwa as terdakwa_nama',
                    'bendahara_pegawai.nama_pegawai as bendahara_nama',
                    'saksi1_pegawai.nama_pegawai as saksi1_nama',
                    'saksi2_pegawai.nama_pegawai as saksi2_nama'
                )->get();
        
        $totalItems = count($data);
        
        // $data = $data->get();
        $mpdf->WriteHTML(view('bensus.cetakbensus', compact('data', 'totalItems')));
        $mpdf->Output();
    }

    function download_pdf()
    {
        $mpdf = new \Mpdf\Mpdf();
        $data = bensus::join('pegawai as jaksa_pegawai', 'jaksa_pegawai.id_pegawai', '=', 'bensus.jaksa')
                ->join('terdakwa as terdakwa_terdakwa', 'terdakwa_terdakwa.id_terdakwa', '=', 'bensus.terdakwa')
                ->join('pegawai as bendahara_pegawai', 'bendahara_pegawai.id_pegawai', '=', 'bensus.bendahara')
                ->join('pegawai as saksi1_pegawai', 'saksi1_pegawai.id_pegawai', '=', 'bensus.saksi1')
                ->join('pegawai as saksi2_pegawai', 'saksi2_pegawai.id_pegawai', '=', 'bensus.saksi2')
                ->select(
                    'bensus.*',
                    'jaksa_pegawai.nama_pegawai as jaksa_nama',
                    'terdakwa_terdakwa.nama_terdakwa as terdakwa_nama',
                    'bendahara_pegawai.nama_pegawai as bendahara_nama',
                    'saksi1_pegawai.nama_pegawai as saksi1_nama',
                    'saksi2_pegawai.nama_pegawai as saksi2_nama'
                )->get();
        
        $totalItems = count($data);
        
        // $data = $data->get();
        $mpdf->WriteHTML(view('bensus.cetakbensus', compact('data', 'totalItems')));
        $mpdf->Output('download-pdf-bensus.pdf','D');
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['terdakwa']=terdakwa::all();
        $data['jaksa'] = pegawai::where('status', 'jaksa')->get();
        $data['bendahara'] = pegawai::where('status', 'tata usaha')->get();
        $data['saksi1'] = pegawai::all();
        $data['saksi2'] = pegawai::all();
        return view ('bensus.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Session::flash('hari', $request->hari);
        Session::flash('tgl_bensus', $request->tgl_bensus);
        Session::flash('jaksa', $request->jaksa);
        Session::flash('terdakwa', $request->terdakwa);
        Session::flash('jumlah_uang', $request->jumlah_uang);
        Session::flash('keterangan_uang', $request->keterangan_uang);
        Session::flash('bendahara', $request->bendahara);
        Session::flash('tujuan_setoran', $request->tujuan_setoran);
        Session::flash('bank_setoran', $request->bank_setoran);
        Session::flash('alamat_bank', $request->alamat_bank);
        Session::flash('saksi1', $request->saksi1);
        Session::flash('saksi2', $request->saksi2);
        Session::flash('arsip', $request->arsip);
        Session::flash('status_bensus', $request->status_bensus);
        
        //contoh itu nama table, dan nim itu nama kolom nya
        $request->validate([ 
            'hari' => 'required',
            'tgl_bensus' => 'required',
            'jaksa' => 'required',
            'terdakwa' => 'required',
            'jumlah_uang' => 'required',
            'keterangan_uang' => 'required',
            'bendahara' => 'required',
            'tujuan_setoran' => 'required',
            'bank_setoran' => 'required',
            'alamat_bank' => 'required',
            'saksi1' => 'required',
            'saksi2' => 'required',
        ], [ 
            'hari.required' => 'Hari wajib diisi',
            'tgl_bensus.required' => 'Tanggal wajib diisi',
            'jaksa.required' => 'Jaksa wajib diisi',
            'terdakwa.required' => 'Nama Terdakwa wajib diisi',
            'jumlah_uang' => 'Jumlah Uang wajib diisi',
            'keterangan_uang' => 'Keterangan Uang wajib diisi',
            'bendahara.required' => 'Bendahara wajib diisi',
            'tujuan_setoran' => 'Tujuan setoran wajib diisi',
            'bank_setoran' => 'Bank setoran wajib diisi',
            'alamat_bank' => 'Alamat bank wajib diisi',
            'saksi1.required' => 'Saksi 1 wajib diisi',
            'saksi2.required' => 'Saksi 2 wajib diisi',
        ]);

        $data = [  
            'hari' => $request->hari,
            'tgl_bensus' => $request->tgl_bensus,
            'jaksa' => $request->jaksa,
            'terdakwa' => $request->terdakwa,
            'jumlah_uang' => $request->jumlah_uang,
            'keterangan_uang' => $request->keterangan_uang,
            'bendahara' => $request->bendahara,
            'tujuan_setoran' => $request->tujuan_setoran,
            'bank_setoran' => $request->bank_setoran,
            'alamat_bank' => $request->alamat_bank,
            'saksi1' => $request->saksi1,
            'saksi2' => $request->saksi2,
            'arsip' => $request->arsip,
            'status_bensus' => $request->arsip !== null ? 'Sudah dieksekusi' : 'Belum dieksekusi',
        ];

        try {
            bensus::create($data);
            return redirect()->to('beritaacara/bensus')->with('success', 'Berhasil menambahkan data');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menambahkan data: ' . $e->getMessage());
        }
        
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
        // $data['terdakwa'] = terdakwa::where('id', $id)->first();
        // $data['jaksa'] = pegawai::where('jabatan', 'jaksa')->get();
        // $data['petugas_bb'] = pegawai::where('jabatan', 'petugas bb')->get();
        // $data = terdakwa::where('id', '$id')->find($id);

        $dataterdakwa = terdakwa::all();
        $datajaksa = pegawai::where('status', 'jaksa')->get();
        $databendahara = pegawai::where('status', 'tata usaha')->get();
        $datasaksi1 = pegawai::all();
        $datasaksi2 = pegawai::all();
        $data = bensus::where('id_bensus', $id)->first();
        return view('bensus.edit') 
                    ->with('data', $data)
                    ->with('dataterdakwa', $dataterdakwa)
                    ->with('datajaksa', $datajaksa)
                    ->with('databendahara', $databendahara)
                    ->with('datasaksi1', $datasaksi1)
                    ->with('datasaksi2', $datasaksi2);
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
            'hari' => 'required',
            'tgl_bensus' => 'required',
            'jaksa' => 'required',
            'terdakwa' => 'required',
            'jumlah_uang' => 'required',
            'keterangan_uang' => 'required',
            'bendahara' => 'required',
            'tujuan_setoran' => 'required',
            'bank_setoran' => 'required',
            'alamat_bank' => 'required',
            'saksi1' => 'required',
            'saksi2' => 'required',
        ], [ 
            'hari.required' => 'Hari wajib diisi',
            'tgl_bensus.required' => 'Tanggal wajib diisi',
            'jaksa.required' => 'Jaksa wajib diisi',
            'terdakwa.required' => 'Nama Terdakwa wajib diisi',
            'jumlah_uang' => 'Jumlah Uang wajib diisi',
            'keterangan_uang' => 'Keterangan Uang wajib diisi',
            'bendahara.required' => 'Bendahara wajib diisi',
            'tujuan_setoran' => 'Tujuan setoran wajib diisi',
            'bank_setoran' => 'Bank setoran wajib diisi',
            'alamat_bank' => 'Alamat bank wajib diisi',
            'saksi1.required' => 'Saksi 1 wajib diisi',
            'saksi2.required' => 'Saksi 2 wajib diisi',
        ]);

        $data = [  
            'hari' => $request->hari,
            'tgl_bensus' => $request->tgl_bensus,
            'jaksa' => $request->jaksa,
            'terdakwa' => $request->terdakwa,
            'jumlah_uang' => $request->jumlah_uang,
            'keterangan_uang' => $request->keterangan_uang,
            'bendahara' => $request->bendahara,
            'tujuan_setoran' => $request->tujuan_setoran,
            'bank_setoran' => $request->bank_setoran,
            'alamat_bank' => $request->alamat_bank,
            'saksi1' => $request->saksi1,
            'saksi2' => $request->saksi2,
            'arsip' => $request->arsip, 
            'status_bensus' => $request->arsip !== null ? 'Sudah dieksekusi' : 'Belum dieksekusi',
        ];

        $data['terdakwa'] = $request->terdakwa;
        $data['jaksa'] = $request->jaksa;
        $data['bendahara'] = $request->bendahara;
        $data['saksi1'] = $request->saksi1;
        $data['saksi2'] = $request->saksi2;
    
        try {
            bensus::where('id_bensus',$id)->update($data);
            return redirect()->to('beritaacara/bensus')->with('success', 'Berhasil melakukan update data');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal melakukan update data: ' . $e->getMessage());
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        bensus::where('id_bensus', $id)->delete();
        return redirect()->to('beritaacara/bensus')->with('success', 'Berhasil melakukan delete data');
    }

    public function print_bensus($id)
    {
        $dataFilter = bensus::join('pegawai as jaksa_pegawai_print', 'jaksa_pegawai_print.id_pegawai', '=', 'bensus.jaksa')
            ->join('pangkat as jaksa_pangkat', 'jaksa_pegawai_print.id_pangkat', '=', 'jaksa_pangkat.id_pangkat') // Join dengan tabel pangkat untuk jaksa
            ->join('pegawai as bendahara_pegawai_print', 'bendahara_pegawai_print.id_pegawai', '=', 'bensus.bendahara')
            ->join('pangkat as bendahara_pangkat', 'bendahara_pegawai_print.id_pangkat', '=', 'bendahara_pangkat.id_pangkat')
            ->join('terdakwa as terdakwa_terdakwa_print', 'terdakwa_terdakwa_print.id_terdakwa', '=', 'bensus.terdakwa')
            ->join('pegawai as saksi1_pegawai_print', 'saksi1_pegawai_print.id_pegawai', '=', 'bensus.saksi1')
            ->join('pangkat as saksi1_pangkat', 'saksi1_pegawai_print.id_pangkat', '=', 'saksi1_pangkat.id_pangkat')
            ->join('pegawai as saksi2_pegawai_print', 'saksi2_pegawai_print.id_pegawai', '=', 'bensus.saksi2')
            ->join('pangkat as saksi2_pangkat', 'saksi2_pegawai_print.id_pangkat', '=', 'saksi2_pangkat.id_pangkat')
            ->select(
                'bensus.*',
                'terdakwa_terdakwa_print.nama_terdakwa as terdakwa_nama',
                'terdakwa_terdakwa_print.pasal as terdakwa_pasal',
                'terdakwa_terdakwa_print.no_putusan as terdakwa_no_putusan',
                'terdakwa_terdakwa_print.tgl_putusan as terdakwa_tgl_putusan',
                'terdakwa_terdakwa_print.alamat_terdakwa as terdakwa_alamat',
                'jaksa_pegawai_print.nama_pegawai as jaksa_nama',
                'jaksa_pangkat.nama_pangkat as jaksa_pangkat', // Ambil nama_pangkat dari tabel pangkat untuk jaksa
                'jaksa_pegawai_print.nip as jaksa_nip',
                'bendahara_pegawai_print.nama_pegawai as bendahara_nama',
                'bendahara_pangkat.nama_pangkat as bendahara_pangkat', // Ambil nama_pangkat dari tabel pangkat untuk jaksa
                'bendahara_pegawai_print.nip as bendahara_nip',
                'saksi1_pegawai_print.nama_pegawai as saksi1_nama',
                'saksi1_pangkat.nama_pangkat as saksi1_pangkat',
                'saksi1_pegawai_print.nip as saksi1_nip',
                'saksi2_pegawai_print.nama_pegawai as saksi2_nama',
                'saksi2_pangkat.nama_pangkat as saksi2_pangkat',
                'saksi2_pegawai_print.nip as saksi2_nip',
            )
            ->where('bensus.id_bensus', $id)
            ->first();

        return view('bensus.beritaacarabensus', compact('dataFilter'));
    }
}
