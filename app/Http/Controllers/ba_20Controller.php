<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Gate;
use \Mpdf\Mpdf;

use App\Models\pegawai;
use App\Models\terdakwa;
use App\Models\ba_20;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Barryvdh\DomPDF\Facade as PDF;
use Barryvdh\DomPDF\PDF as DomPDFPDF;

class ba_20Controller extends Controller
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
            $data = ba_20::leftJoin('terdakwa as terdakwa_terdakwa', 'terdakwa_terdakwa.id_terdakwa', '=', 'ba_20.terdakwa')
                ->leftJoin('pegawai as jaksa_pegawai', 'jaksa_pegawai.id_pegawai', '=', 'ba_20.jaksa')
                ->leftJoin('pegawai as kasi_bb_pegawai', 'kasi_bb_pegawai.id_pegawai', '=', 'ba_20.kasi_bb')
                ->leftJoin('pegawai as saksi1_pegawai', 'saksi1_pegawai.id_pegawai', '=', 'ba_20.saksi1')
                ->leftJoin('pegawai as saksi2_pegawai', 'saksi2_pegawai.id_pegawai', '=', 'ba_20.saksi2')
                ->select(
                    'ba_20.*',
                    'terdakwa_terdakwa.nama_terdakwa as terdakwa_nama',
                    'jaksa_pegawai.nama_pegawai as jaksa_nama',
                    'kasi_bb_pegawai.nama_pegawai as kasi_bb_nama',
                    'saksi1_pegawai.nama_pegawai as saksi1_nama',
                    'saksi2_pegawai.nama_pegawai as saksi2_nama'
                )  
                ->where(function($query) use ($katakunci) {
                    $query->where('terdakwa_terdakwa.nama_terdakwa','like',"%$katakunci%")
                        ->orWhere('hari','like',"%$katakunci%")
                        ->orWhere('tanggal','like',"%$katakunci%")
                        ->orWhere('jaksa_pegawai.nama_pegawai','like',"%$katakunci%")
                        ->orWhere('dikembalikan','like',"%$katakunci%")
                        ->orWhere('nama_penerima','like',"%$katakunci%")
                        ->orWhere('pekerjaan_ba20','like',"%$katakunci%")
                        ->orWhere('alamat_ba20','like',"%$katakunci%")
                        ->orWhere('kasi_bb_pegawai.nama_pegawai','like',"%$katakunci%")
                        ->orWhere('saksi1_pegawai.nama_pegawai','like',"%$katakunci%")
                        ->orWhere('saksi2_pegawai.nama_pegawai','like',"%$katakunci%")
                        ->orWhere('barang_bukti_ba20','like',"%$katakunci%")
                        ->orWhere('dokumentasi','like',"%$katakunci%")
                        ->orWhere('arsip','like',"%$katakunci%")
                        ->orWhere('status_ba20','like',"%$katakunci%");
                })->paginate($jumlahbaris);
        } else {
            $data = ba_20::leftJoin('terdakwa as terdakwa_terdakwa', 'terdakwa_terdakwa.id_terdakwa', '=', 'ba_20.terdakwa')
                ->leftJoin('pegawai as jaksa_pegawai', 'jaksa_pegawai.id_pegawai', '=', 'ba_20.jaksa')
                ->leftJoin('pegawai as kasi_bb_pegawai', 'kasi_bb_pegawai.id_pegawai', '=', 'ba_20.kasi_bb')
                ->leftJoin('pegawai as saksi1_pegawai', 'saksi1_pegawai.id_pegawai', '=', 'ba_20.saksi1')
                ->leftJoin('pegawai as saksi2_pegawai', 'saksi2_pegawai.id_pegawai', '=', 'ba_20.saksi2')
                ->select(
                    'ba_20.*',
                    'terdakwa_terdakwa.nama_terdakwa as terdakwa_nama',
                    'jaksa_pegawai.nama_pegawai as jaksa_nama',
                    'kasi_bb_pegawai.nama_pegawai as kasi_bb_nama',
                    'saksi1_pegawai.nama_pegawai as saksi1_nama',
                    'saksi2_pegawai.nama_pegawai as saksi2_nama'
                )   
            ->orderBy('tanggal', 'desc')->paginate($jumlahbaris);
        }
        return view ('ba20.index')->with('data', $data);
        
        // paginate() untuk menampilkan data ga semua nya dibagi gitu
        // $data = contoh::orderBy('nim', 'desc')->paginate(1);
    }

   function view_pdf()
   {
    $mpdf = new \Mpdf\Mpdf();
    $data = ba_20::join('terdakwa as terdakwa_terdakwa', 'terdakwa_terdakwa.id_terdakwa', '=', 'ba_20.terdakwa')
                ->join('pegawai as jaksa_pegawai', 'jaksa_pegawai.id_pegawai', '=', 'ba_20.jaksa')
                ->join('pegawai as kasi_bb_pegawai', 'kasi_bb_pegawai.id_pegawai', '=', 'ba_20.kasi_bb')
                ->join('pegawai as saksi1_pegawai', 'saksi1_pegawai.id_pegawai', '=', 'ba_20.saksi1')
                ->join('pegawai as saksi2_pegawai', 'saksi2_pegawai.id_pegawai', '=', 'ba_20.saksi2')
                ->select(
                    'ba_20.*',
                    'terdakwa_terdakwa.nama_terdakwa as terdakwa_nama',
                    'jaksa_pegawai.nama_pegawai as jaksa_nama',
                    'kasi_bb_pegawai.nama_pegawai as kasi_bb_nama',
                    'saksi1_pegawai.nama_pegawai as saksi1_nama',
                    'saksi2_pegawai.nama_pegawai as saksi2_nama'
                )->get();
    
     $totalItems = count($data);
    
    // $data = $data->get();
    $mpdf->WriteHTML(view('ba20.cetakba20', compact('data', 'totalItems')));
    $mpdf->Output();
   }

   function download_pdf()
   {
    $mpdf = new \Mpdf\Mpdf();
    $data = ba_20::join('terdakwa as terdakwa_terdakwa', 'terdakwa_terdakwa.id_terdakwa', '=', 'ba_20.terdakwa')
                ->join('pegawai as jaksa_pegawai', 'jaksa_pegawai.id_pegawai', '=', 'ba_20.jaksa')
                ->join('pegawai as kasi_bb_pegawai', 'kasi_bb_pegawai.id_pegawai', '=', 'ba_20.kasi_bb')
                ->join('pegawai as saksi1_pegawai', 'saksi1_pegawai.id_pegawai', '=', 'ba_20.saksi1')
                ->join('pegawai as saksi2_pegawai', 'saksi2_pegawai.id_pegawai', '=', 'ba_20.saksi2')
                ->select(
                    'ba_20.*',
                    'terdakwa_terdakwa.nama_terdakwa as terdakwa_nama',
                    'jaksa_pegawai.nama_pegawai as jaksa_nama',
                    'kasi_bb_pegawai.nama_pegawai as kasi_bb_nama',
                    'saksi1_pegawai.nama_pegawai as saksi1_nama',
                    'saksi2_pegawai.nama_pegawai as saksi2_nama'
                )->get();
    
     $totalItems = count($data);
    
    // $data = $data->get();
    $mpdf->WriteHTML(view('ba20.cetakba20', compact('data', 'totalItems')));
    $mpdf->Output('download-pdf-ba20.pdf','D');
   }

//    public function print()
// {
//     try {
//         // Operasi pembuatan PDF
//         $mpdf = new Mpdf();
//         $data = ba_20::join('terdakwa as terdakwa_terdakwa', 'terdakwa_terdakwa.id_terdakwa', '=', 'ba_20.terdakwa')
//             ->join('pegawai as jaksa_pegawai', 'jaksa_pegawai.id_pegawai', '=', 'ba_20.jaksa')
//             ->join('pegawai as kasi_bb_pegawai', 'kasi_bb_pegawai.id_pegawai', '=', 'ba_20.kasi_bb')
//             ->join('pegawai as saksi1_pegawai', 'saksi1_pegawai.id_pegawai', '=', 'ba_20.saksi1')
//             ->join('pegawai as saksi2_pegawai', 'saksi2_pegawai.id_pegawai', '=', 'ba_20.saksi2')
//             ->select(
//                 'ba_20.*',
//                 'terdakwa_terdakwa.nama_terdakwa as terdakwa_nama',
//                 'jaksa_pegawai.nama_pegawai as jaksa_nama',
//                 'kasi_bb_pegawai.nama_pegawai as kasi_bb_nama',
//                 'saksi1_pegawai.nama_pegawai as saksi1_nama',
//                 'saksi2_pegawai.nama_pegawai as saksi2_nama'
//             )->get();

//         $totalItems = count($data);

//         // Render tampilan ke HTML
//         $html = view('ba20.cetakba20', compact('data', 'totalItems'))->render();

//         // Tambahkan konten HTML ke mPDF
//         $mpdf->WriteHTML($html);

//         // Output PDF
//         $mpdf->Output('', 'S');

//         return $this->generatePdfResponse($mpdf);
//     } catch (\Exception $e) {
//         // Tangani atau laporkan kesalahan
//         return redirect()->back()->with('error', 'Gagal mencetak PDF: ' . $e->getMessage());
//     } finally {
//         // Bersihkan sumber daya mPDF
//         if (isset($mpdf)) {
//             $mpdf->cleanup();
//         }
//     }
// }

// private function generatePdfResponse($mpdf)
// {
//     // Simpan output PDF ke file sementara
//     $output = $mpdf->Output('', 'S');

//     // Berikan response untuk diunduh oleh pengguna
//     $response = Response::make($output, 200, [
//         'Content-Type' => 'application/pdf',
//         'Content-Disposition' => 'inline; filename=print-pdf-ba20.pdf', // Menampilkan langsung di browser
//     ]);

//     // Sisipkan skrip JavaScript untuk membuka dialog pencetakan
//     $response->setContent($response->getContent() . "<script type='text/javascript'>window.onload = function() { window.print(); }</script>");

//     return $response;
// }

    // public function cetakForm(){
    //     return view('rekapan_data_pemusnahan.cetakba20_form');
    // }


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
        return view ('ba20.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Session::flash('terdakwa', $request->terdakwa);
        Session::flash('hari', $request->hari);
        Session::flash('tanggal', $request->tanggal);
        Session::flash('jaksa', $request->jaksa);
        Session::flash('dikembalikan', $request->dikembalikan);
        Session::flash('nama_penerima', $request->nama_penerima);
        Session::flash('pekerjaan_ba20', $request->pekerjaan_ba20);
        Session::flash('alamat_ba20', $request->alamat_ba20);
        Session::flash('kasi_bb', $request->kasi_bb);
        Session::flash('saksi1', $request->saksi1);
        Session::flash('saksi2', $request->saksi2);
        Session::flash('barang_bukti_ba20', $request->barang_bukti_ba20);
        Session::flash('dokumentasi', $request->dokumentasi);
        Session::flash('arsip', $request->arsip);
        Session::flash('status_ba20', $request->status_ba20);
        
        //contoh itu nama table, dan nim itu nama kolom nya
        $request->validate([ 
            'terdakwa' => 'required',
            'hari' => 'required',
            'tanggal' => 'required',
            'jaksa' => 'required',
            'dikembalikan' => 'required',
            'nama_penerima' => 'required',
            'pekerjaan_ba20' => 'required',
            'alamat_ba20' => 'required',
            'kasi_bb' => 'required',
            'saksi1' => 'required',
            'saksi2' => 'required',
            'barang_bukti_ba20' => 'required',
            // 'status' => 'required',
        ], [ 
            'terdakwa.required' => 'Nama Terdakwa wajib diisi',
            'hari.required' => 'Hari wajib diisi',
            'tanggal.required' => 'Tanggal wajib diisi',
            'jaksa.required' => 'Jaksa wajib diisi',
            'dikembalikan.required' => 'Dikembalikan wajib diisi',
            'nama_penerima.required' => 'Nama Penerima wajib diisi',
            'pekerjaan_ba20.required' => 'Pekerjaan wajib diisi',
            'alamat_ba20.required' => 'Alamat wajib diisi',
            'kasi_bb.required' => 'Kasi BB wajib diisi',
            'saksi1.required' => 'Saksi 1 wajib diisi',
            'saksi2.required' => 'Saksi 2 wajib diisi',
            'barang_bukti_ba20.required' => 'Barang Bukti wajib diisi',
            // 'status.required' => 'Status wajib diisi',
        ]);

        $data = [
            'terdakwa' => $request->terdakwa,
            'hari' => $request->hari,
            'tanggal' => $request->tanggal,
            'jaksa' => $request->jaksa,
            'dikembalikan' => $request->dikembalikan,
            'nama_penerima' => $request->nama_penerima,
            'pekerjaan_ba20' => $request->pekerjaan_ba20,
            'alamat_ba20' => $request->alamat_ba20,
            'kasi_bb' => $request->kasi_bb,
            'saksi1' => $request->saksi1,
            'saksi2' => $request->saksi2,
            'barang_bukti_ba20' => $request->barang_bukti_ba20,
            'dokumentasi' => $request->dokumentasi,
            'arsip' => $request->arsip,
            'status_ba20' => $request->arsip !== null ? 'Sudah dieksekusi' : 'Belum dieksekusi',
        ];

         // Coba menyimpan data
        try {
            // Menggunakan Eloquent untuk menyimpan data
            ba_20::create($data);
            
            // Redirect dengan pesan sukses
            return redirect()->to('beritaacara/ba20')->with('success', 'Berhasil menambahkan data');
        } catch (\Exception $e) {
            // Tangani kesalahan, redirect dengan pesan error
            return redirect()->back()->with('error', 'Gagal menambahkan data: ' . $e->getMessage());
        }
            
        // ba_20::create($data);
        // return redirect()->to('beritaacara/ba20')->with('success', 'Berhasil menambahkan data');
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
        $datakasi_bb = pegawai::where('status', 'jaksa')->get();
        $datasaksi1 = pegawai::all();
        $datasaksi2 = pegawai::all();
        $data = ba_20::where('id_ba20', $id)->first();
        return view('ba20.edit') 
                    ->with('data', $data)
                    ->with('dataterdakwa', $dataterdakwa)
                    ->with('datajaksa', $datajaksa)
                    ->with('datakasi_bb', $datakasi_bb)
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
            'terdakwa' => 'required',
            'hari' => 'required',
            'tanggal' => 'required',
            'jaksa' => 'required',
            'dikembalikan' => 'required',
            'nama_penerima' => 'required',
            'pekerjaan_ba20' => 'required',
            'alamat_ba20' => 'required',
            'kasi_bb' => 'required',
            'saksi1' => 'required',
            'saksi2' => 'required',
            'barang_bukti_ba20' => 'required',
            // 'status' => 'required',
        ], [ 
            'terdakwa.required' => 'Id Terdakwa wajib diisi',
            'hari.required' => 'Hari wajib diisi',
            'tanggal.required' => 'Tanggal wajib diisi',
            'jaksa.required' => 'Jaksa wajib diisi',
            'dikembalikan.required' => 'Dikembalikan wajib diisi',
            'nama_penerima.required' => 'Nama Penerima wajib diisi',
            'pekerjaan_ba20.required' => 'Pekerjaan wajib diisi',
            'alamat_ba20.required' => 'Alamat wajib diisi',
            'kasi_bb.required' => 'Kasi BB wajib diisi',
            'saksi1.required' => 'Saksi 1 wajib diisi',
            'saksi2.required' => 'Saksi 2 wajib diisi',
            'barang_bukti_ba20.required' => 'Barang Bukti wajib diisi',
            // 'status.required' => 'Status wajib diisi',
        ]);

        $data = [
            'terdakwa' => $request->id_terdakwa,
            'hari' => $request->hari,
            'tanggal' => $request->tanggal,
            'jaksa' => $request->jaksa,
            'dikembalikan' => $request->dikembalikan,
            'nama_penerima' => $request->nama_penerima,
            'pekerjaan_ba20' => $request->pekerjaan_ba20,
            'alamat_ba20' => $request->alamat_ba20,
            'kasi_bb' => $request->kasi_bb,
            'saksi1' => $request->saksi1,
            'saksi2' => $request->saksi2,
            'barang_bukti_ba20' => $request->barang_bukti_ba20,
            'dokumentasi' => $request->dokumentasi,
            'arsip' => $request->arsip,
            'status_ba20' => $request->arsip !== null ? 'Sudah dieksekusi' : 'Belum dieksekusi',
        ];

        $data['terdakwa'] = $request->terdakwa;
        $data['jaksa'] = $request->jaksa;
        $data['kasi_bb'] = $request->kasi_bb;
        $data['saksi1'] = $request->saksi1;
        $data['saksi2'] = $request->saksi2;
    
        try {
            ba_20::where('id_ba20', $id)->update($data);
            return redirect()->to('beritaacara/ba20')->with('success', 'Berhasil melakukan update data');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal melakukan update data: ' . $e->getMessage());
        }
        // ba_20::where('id_ba20',$id)->update($data);
        // return redirect()->to('beritaacara/ba20')->with('success', 'Berhasil melakukan update data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        ba_20::where('id_ba20', $id)->delete();
        return redirect()->to('beritaacara/ba20')->with('success', 'Berhasil melakukan delete data');
    }

    public function print_ba20($id)
    {
        $dataFilter = ba_20::join('pegawai as jaksa_pegawai_print', 'jaksa_pegawai_print.id_pegawai', '=', 'ba_20.jaksa')
            ->join('pangkat as jaksa_pangkat', 'jaksa_pegawai_print.id_pangkat', '=', 'jaksa_pangkat.id_pangkat') // Join dengan tabel pangkat untuk jaksa
            ->join('terdakwa as terdakwa_terdakwa_print', 'terdakwa_terdakwa_print.id_terdakwa', '=', 'ba_20.terdakwa')
            ->join('pegawai as kasi_bb_pegawai_print', 'kasi_bb_pegawai_print.id_pegawai', '=', 'ba_20.kasi_bb')
            ->join('pangkat as kasi_bb_pangkat', 'kasi_bb_pegawai_print.id_pangkat', '=', 'kasi_bb_pangkat.id_pangkat')
            ->join('pegawai as saksi1_pegawai_print', 'saksi1_pegawai_print.id_pegawai', '=', 'ba_20.saksi1')
            ->join('pegawai as saksi2_pegawai_print', 'saksi2_pegawai_print.id_pegawai', '=', 'ba_20.saksi2')
            ->select(
                'ba_20.*',
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
                'saksi2_pegawai_print.nama_pegawai as saksi2_nama'
            )
            ->where('ba_20.id_ba20', $id)
            ->first();

        return view('ba20.beritaacaraba20', compact('dataFilter'));
    }
   
}
