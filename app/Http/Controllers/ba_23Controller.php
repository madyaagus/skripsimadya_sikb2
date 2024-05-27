<?php

namespace App\Http\Controllers;

use App\Models\pegawai;
use App\Models\terdakwa;
use App\Models\ba_23;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;

class ba_23Controller extends Controller
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
            $data = ba_23::leftJoin('pegawai as jaksa_pegawai', 'jaksa_pegawai.id_pegawai', '=', 'ba_23.jaksa')
                ->leftJoin('terdakwa as terdakwa_terdakwa', 'terdakwa_terdakwa.id_terdakwa', '=', 'ba_23.terdakwa')
                ->leftJoin('pegawai as kasi_bb_pegawai', 'kasi_bb_pegawai.id_pegawai', '=', 'ba_23.kasi_bb')
                ->leftJoin('pegawai as saksi1_pegawai', 'saksi1_pegawai.id_pegawai', '=', 'ba_23.saksi1')
                ->leftJoin('pegawai as saksi2_pegawai', 'saksi2_pegawai.id_pegawai', '=', 'ba_23.saksi2')
                ->select(
                    'ba_23.*',                    
                    'jaksa_pegawai.nama_pegawai as jaksa_nama',
                    'terdakwa_terdakwa.nama_terdakwa as terdakwa_nama',
                    'kasi_bb_pegawai.nama_pegawai as kasi_bb_nama',
                    'saksi1_pegawai.nama_pegawai as saksi1_nama',
                    'saksi2_pegawai.nama_pegawai as saksi2_nama'
                )  
                ->where(function($query) use ($katakunci) {
                    $query->where('hari','like',"%$katakunci%")
                        ->orWhere('tgl_ba23','like',"%$katakunci%")
                        ->orWhere('jaksa_pegawai.nama_pegawai','like',"%$katakunci%")
                        ->orWhere('terdakwa_terdakwa.nama_terdakwa','like',"%$katakunci%")
                        ->orWhere('kasi_bb_pegawai.nama_pegawai','like',"%$katakunci%")
                        ->orWhere('saksi1_pegawai.nama_pegawai','like',"%$katakunci%")
                        ->orWhere('saksi2','like',"%$katakunci%")
                        ->orWhere('saksi2_pegawai.nama_pegawai','like',"%$katakunci%")
                        ->orWhere('arsip','like',"%$katakunci%")
                        ->orWhere('status_ba23','like',"%$katakunci%");
                })->paginate($jumlahbaris);
        } else {
            $data =ba_23::leftJoin('pegawai as jaksa_pegawai', 'jaksa_pegawai.id_pegawai', '=', 'ba_23.jaksa')
            ->leftJoin('terdakwa as terdakwa_terdakwa', 'terdakwa_terdakwa.id_terdakwa', '=', 'ba_23.terdakwa')
            ->leftJoin('pegawai as kasi_bb_pegawai', 'kasi_bb_pegawai.id_pegawai', '=', 'ba_23.kasi_bb')
            ->leftJoin('pegawai as saksi1_pegawai', 'saksi1_pegawai.id_pegawai', '=', 'ba_23.saksi1')
            ->leftJoin('pegawai as saksi2_pegawai', 'saksi2_pegawai.id_pegawai', '=', 'ba_23.saksi2')
            ->select(
                'ba_23.*',
                'terdakwa_terdakwa.nama_terdakwa as terdakwa_nama',
                'jaksa_pegawai.nama_pegawai as jaksa_nama',
                'kasi_bb_pegawai.nama_pegawai as kasi_bb_nama',
                'saksi1_pegawai.nama_pegawai as saksi1_nama',
                'saksi2_pegawai.nama_pegawai as saksi2_nama'
            )  
            ->orderBy('tgl_ba23', 'desc')->paginate($jumlahbaris);
        }
        return view ('ba23.index')->with('data', $data);
        
        // paginate() untuk menampilkan data ga semua nya dibagi gitu
        // $data = contoh::orderBy('nim', 'desc')->paginate(1);
    }

    function view_pdf()
    {
        $mpdf = new \Mpdf\Mpdf();
        $data = ba_23::join('pegawai as jaksa_pegawai', 'jaksa_pegawai.id_pegawai', '=', 'ba_23.jaksa')
                ->join('terdakwa as terdakwa_terdakwa', 'terdakwa_terdakwa.id_terdakwa', '=', 'ba_23.terdakwa')
                ->join('pegawai as kasi_bb_pegawai', 'kasi_bb_pegawai.id_pegawai', '=', 'ba_23.kasi_bb')
                ->join('pegawai as saksi1_pegawai', 'saksi1_pegawai.id_pegawai', '=', 'ba_23.saksi1')
                ->join('pegawai as saksi2_pegawai', 'saksi2_pegawai.id_pegawai', '=', 'ba_23.saksi2')
                ->select(
                    'ba_23.*',                    
                    'jaksa_pegawai.nama_pegawai as jaksa_nama',
                    'terdakwa_terdakwa.nama_terdakwa as terdakwa_nama',
                    'kasi_bb_pegawai.nama_pegawai as kasi_bb_nama',
                    'saksi1_pegawai.nama_pegawai as saksi1_nama',
                    'saksi2_pegawai.nama_pegawai as saksi2_nama'
                )->get();
                
        $totalItems = count($data);
        
        $mpdf->WriteHTML(view('ba23.cetakba23', compact('data', 'totalItems')));
        $mpdf->Output();
    }

    function download_pdf()
    {
        $mpdf = new \Mpdf\Mpdf();
        $data = ba_23::join('pegawai as jaksa_pegawai', 'jaksa_pegawai.id_pegawai', '=', 'ba_23.jaksa')
                ->join('terdakwa as terdakwa_terdakwa', 'terdakwa_terdakwa.id_terdakwa', '=', 'ba_23.terdakwa')
                ->join('pegawai as kasi_bb_pegawai', 'kasi_bb_pegawai.id_pegawai', '=', 'ba_23.kasi_bb')
                ->join('pegawai as saksi1_pegawai', 'saksi1_pegawai.id_pegawai', '=', 'ba_23.saksi1')
                ->join('pegawai as saksi2_pegawai', 'saksi2_pegawai.id_pegawai', '=', 'ba_23.saksi2')
                ->select(
                    'ba_23.*',                    
                    'jaksa_pegawai.nama_pegawai as jaksa_nama',
                    'terdakwa_terdakwa.nama_terdakwa as terdakwa_nama',
                    'kasi_bb_pegawai.nama_pegawai as kasi_bb_nama',
                    'saksi1_pegawai.nama_pegawai as saksi1_nama',
                    'saksi2_pegawai.nama_pegawai as saksi2_nama'
                )->get();
                
        $totalItems = count($data);
        
        $mpdf->WriteHTML(view('ba23.cetakba23', compact('data', 'totalItems')));
        $mpdf->Output('download-pdf-ba23.pdf', 'D');
    }

    function print()
    {
        $data = ba_23::join('pegawai as jaksa_pegawai', 'jaksa_pegawai.id_pegawai', '=', 'ba_23.jaksa')
                ->join('terdakwa as terdakwa_terdakwa', 'terdakwa_terdakwa.id_terdakwa', '=', 'ba_23.terdakwa')
                ->join('pegawai as kasi_bb_pegawai', 'kasi_bb_pegawai.id_pegawai', '=', 'ba_23.kasi_bb')
                ->join('pegawai as saksi1_pegawai', 'saksi1_pegawai.id_pegawai', '=', 'ba_23.saksi1')
                ->join('pegawai as saksi2_pegawai', 'saksi2_pegawai.id_pegawai', '=', 'ba_23.saksi2')
                ->select(
                    'ba_23.*',                    
                    'jaksa_pegawai.nama_pegawai as jaksa_nama',
                    'terdakwa_terdakwa.nama_terdakwa as terdakwa_nama',
                    'kasi_bb_pegawai.nama_pegawai as kasi_bb_nama',
                    'saksi1_pegawai.nama_pegawai as saksi1_nama',
                    'saksi2_pegawai.nama_pegawai as saksi2_nama'
                )->get();
                  
        return view('ba23.printba23', compact('data'));

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
        $data['kasi_bb'] = pegawai::where('status', 'jaksa')->get();
        $data['saksi1'] = pegawai::all();
        $data['saksi2'] = pegawai::all();
        return view ('ba23.create', $data);
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
        Session::flash('tgl_ba23', $request->tgl_ba23);
        Session::flash('jaksa', $request->jaksa);
        Session::flash('terdakwa', $request->terdakwa);
        Session::flash('kasi_bb', $request->kasi_bb);
        Session::flash('saksi1', $request->saksi1);
        Session::flash('saksi2', $request->saksi2);
        Session::flash('barang_bukti_ba23', $request->barang_bukti_ba23);
        Session::flash('arsip', $request->arsip);
        Session::flash('status_ba23', $request->status_ba23);
        
        //contoh itu nama table, dan nim itu nama kolom nya
        $request->validate([ 
            'hari' => 'required',
            'tgl_ba23' => 'required',
            'jaksa' => 'required',
            'terdakwa' => 'required',
            'kasi_bb' => 'required',
            'saksi1' => 'required',
            'saksi2' => 'required',
            'barang_bukti_ba23' => 'required',
        ], [ 
            'hari.required' => 'Hari wajib diisi',
            'tgl_ba23.required' => 'Tanggal wajib diisi',
            'jaksa.required' => 'Jaksa wajib diisi',
            'terdakwa.required' => 'Nama Terdakwa wajib diisi',
            'kasi_bb.required' => 'Kasi BB wajib diisi',
            'saksi1.required' => 'Saksi 1 wajib diisi',
            'saksi2.required' => 'Saksi 2 wajib diisi',
            'barang_bukti_ba23.required' => 'Barang Bukti wajib diisi',
        ]);

        $data = [  
            'hari' => $request->hari,
            'tgl_ba23' => $request->tgl_ba23,
            'jaksa' => $request->jaksa,
            'terdakwa' => $request->terdakwa,
            'kasi_bb' => $request->kasi_bb,
            'saksi1' => $request->saksi1,
            'saksi2' => $request->saksi2,
            'barang_bukti_ba23' => $request->barang_bukti_ba23,
            'arsip' => $request->arsip,
            'status_ba23' => $request->arsip !== null ? 'Sudah dieksekusi' : 'Belum dieksekusi',
        ];

        try{
            ba_23::create($data);
            return redirect()->to('beritaacara/ba23')->with('success', 'Berhasil menambahkan data');
        } catch(\Exception $e) {
            return redirect()->back()->with('eror', 'Gagal menambahkan data: ' . $e->getMessage());
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
        $datakasibb = pegawai::where('status', 'jaksa')->get();
        $datasaksi1 = pegawai::all();
        $datasaksi2 = pegawai::all();
        $data = ba_23::where('id_ba23', $id)->first();
        return view('ba23.edit') 
                    ->with('data', $data)
                    ->with('dataterdakwa', $dataterdakwa)
                    ->with('datajaksa', $datajaksa)
                    ->with('datakasibb', $datakasibb)
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
            'tgl_ba23' => 'required',
            'jaksa' => 'required',
            'terdakwa' => 'required',
            'kasi_bb' => 'required',
            'saksi1' => 'required',
            'saksi2' => 'required',
            'barang_bukti_ba23' => 'required',
        ], [ 
            'hari.required' => 'Hari wajib diisi',
            'tgl_ba23.required' => 'Tanggal wajib diisi',
            'jaksa.required' => 'Jaksa wajib diisi',
            'terdakwa.required' => 'Nama Terdakwa wajib diisi',
            'kasi_bb.required' => 'Kasi BB wajib diisi',
            'saksi1.required' => 'Saksi 1 wajib diisi',
            'saksi2.required' => 'Saksi 2 wajib diisi',
            'barang_bukti_ba23.required' => 'Barang Bukti wajib diisi',
        ]);

        $data = [  
            'hari' => $request->hari,
            'tgl_ba23' => $request->tgl_ba23,
            'jaksa' => $request->jaksa,
            'terdakwa' => $request->terdakwa,
            'kasi_bb' => $request->kasi_bb,
            'saksi1' => $request->saksi1,
            'saksi2' => $request->saksi2,
            'barang_bukti_ba23' => $request->barang_bukti_ba23,
            'arsip' => $request->arsip,
            'status_ba23' => $request->arsip !== null ? 'Sudah dieksekusi' : 'Belum dieksekusi',
        ];

        $data['terdakwa'] = $request->terdakwa;
        $data['jaksa'] = $request->jaksa;
        $data['kasi_bb'] = $request->kasi_bb;
        $data['saksi1'] = $request->saksi1;
        $data['saksi2'] = $request->saksi2;
    
        try{
            ba_23::where('id_ba23',$id)->update($data);
        return redirect()->to('beritaacara/ba23')->with('success', 'Berhasil melakukan update data');
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
        ba_23::where('id_ba23', $id)->delete();
        return redirect()->to('beritaacara/ba23')->with('success', 'Berhasil melakukan delete data');
    }

    public function print_ba23($id)
    {
        $dataFilter = ba_23::join('pegawai as jaksa_pegawai_print', 'jaksa_pegawai_print.id_pegawai', '=', 'ba_23.jaksa')
            ->join('pangkat as jaksa_pangkat', 'jaksa_pegawai_print.id_pangkat', '=', 'jaksa_pangkat.id_pangkat') // Join dengan tabel pangkat untuk jaksa
            ->join('terdakwa as terdakwa_terdakwa_print', 'terdakwa_terdakwa_print.id_terdakwa', '=', 'ba_23.terdakwa')
            ->join('pegawai as kasi_bb_pegawai_print', 'kasi_bb_pegawai_print.id_pegawai', '=', 'ba_23.kasi_bb')
            ->join('pangkat as kasi_bb_pangkat', 'kasi_bb_pegawai_print.id_pangkat', '=', 'kasi_bb_pangkat.id_pangkat')
            ->join('pegawai as saksi1_pegawai_print', 'saksi1_pegawai_print.id_pegawai', '=', 'ba_23.saksi1')
            ->join('pangkat as saksi1_pangkat', 'saksi1_pegawai_print.id_pangkat', '=', 'saksi1_pangkat.id_pangkat')
            ->join('pegawai as saksi2_pegawai_print', 'saksi2_pegawai_print.id_pegawai', '=', 'ba_23.saksi2')
            ->join('pangkat as saksi2_pangkat', 'saksi2_pegawai_print.id_pangkat', '=', 'saksi2_pangkat.id_pangkat')
            ->select(
                'ba_23.*',
                'terdakwa_terdakwa_print.nama_terdakwa as terdakwa_nama',
                'terdakwa_terdakwa_print.pasal as terdakwa_pasal',
                'terdakwa_terdakwa_print.print_p48 as terdakwa_print_p48',
                'terdakwa_terdakwa_print.tgl_p48 as terdakwa_tgl_p48',
                'terdakwa_terdakwa_print.no_putusan as terdakwa_no_putusan',
                'terdakwa_terdakwa_print.tgl_putusan as terdakwa_tgl_putusan',
                'jaksa_pegawai_print.nama_pegawai as jaksa_nama',
                'jaksa_pangkat.nama_pangkat as jaksa_pangkat', // Ambil nama_pangkat dari tabel pangkat untuk jaksa
                'jaksa_pegawai_print.nip as jaksa_nip',
                'kasi_bb_pegawai_print.nama_pegawai as kasi_bb_nama',
                'kasi_bb_pangkat.nama_pangkat as kasi_bb_pangkat', // Ambil nama_pangkat dari tabel pangkat untuk kasi
                'kasi_bb_pegawai_print.nip as kasi_bb_nip',
                'saksi1_pegawai_print.nama_pegawai as saksi1_nama',
                'saksi1_pangkat.nama_pangkat as saksi1_pangkat',
                'saksi1_pegawai_print.nip as saksi1_nip',
                'saksi1_pegawai_print.jabatan as saksi1_jabatan',
                'saksi2_pegawai_print.nama_pegawai as saksi2_nama',
                'saksi2_pangkat.nama_pangkat as saksi2_pangkat',
                'saksi2_pegawai_print.nip as saksi2_nip',
                'saksi2_pegawai_print.jabatan as saksi2_jabatan',
            )
            ->where('ba_23.id_ba23', $id)
            ->first();

        return view('ba23.beritaacaraba23', compact('dataFilter'));
    }
}
