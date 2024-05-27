<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\pegawai;
use App\Models\terdakwa;
use App\Models\ba_23;

use Mpdf\Mpdf;
use Carbon\Carbon;

class rekapandatapemusnahanController extends Controller
{
    public function index(Request $request)
    {
        // Pencarian data
        // strlen yaitu mengecek apakah ada kata kunci atau tidak
        // or where jika kata kunci nya lebih dari satu jadi ga harus sesuai nim
        // else itu jika 
        // paginate() untuk menampilkan data ga semua nya dibagi gitu

        $jumlahbaris = 10;
            $data =ba_23::join('pegawai as jaksa_pegawai', 'jaksa_pegawai.id_pegawai', '=', 'ba_23.jaksa')
            ->join('terdakwa as terdakwa_terdakwa', 'terdakwa_terdakwa.id_terdakwa', '=', 'ba_23.terdakwa')
            ->join('pegawai as kasi_bb_pegawai', 'kasi_bb_pegawai.id_pegawai', '=', 'ba_23.kasi_bb')
            ->join('pegawai as saksi1_pegawai', 'saksi1_pegawai.id_pegawai', '=', 'ba_23.saksi1')
            ->join('pegawai as saksi2_pegawai', 'saksi2_pegawai.id_pegawai', '=', 'ba_23.saksi2')
            ->select(
                'ba_23.*',
                'jaksa_pegawai.nama_pegawai as jaksa_nama',
                'terdakwa_terdakwa.nama_terdakwa as terdakwa_nama',
                // 'terdakwa_terdakwa.no_putusan as terdakwa_no_putusan',
                // 'terdakwa_terdakwa.tgl_putusan as terdakwa_tgl_putusan',
                // 'terdakwa_terdakwa.pasal as terdakwa_pasal',
                // 'terdakwa_terdakwa.barang_bukti as terdakwa_barang_bukti',
                'kasi_bb_pegawai.nama_pegawai as kasi_bb_nama',
                'saksi1_pegawai.nama_pegawai as saksi1_nama',
                'saksi2_pegawai.nama_pegawai as saksi2_nama'
            )  
            ->where('ba_23.status_ba23', 'sudah dieksekusi')
            ->orderBy('tgl_ba23', 'desc')
            ->paginate($jumlahbaris);
        
        return view ('rekapan_data_pemusnahan.index')->with('data', $data);
    }

    public function filter(Request $request){
        $start_date = $request->start_date;
        $end_date = $request->end_date;

        if ($start_date && $end_date) {
            $dataFilter = ba_23::join('pegawai as jaksa_pegawai', 'jaksa_pegawai.id_pegawai', '=', 'ba_23.jaksa')
                ->join('terdakwa as terdakwa_terdakwa', 'terdakwa_terdakwa.id_terdakwa', '=', 'ba_23.terdakwa')
                ->join('pegawai as kasi_bb_pegawai', 'kasi_bb_pegawai.id_pegawai', '=', 'ba_23.kasi_bb')
                ->join('pegawai as saksi1_pegawai', 'saksi1_pegawai.id_pegawai', '=', 'ba_23.saksi1')
                ->join('pegawai as saksi2_pegawai', 'saksi2_pegawai.id_pegawai', '=', 'ba_23.saksi2')
                ->select(
                    'ba_23.*',
                    'jaksa_pegawai.nama_pegawai as jaksa_nama',
                    'terdakwa_terdakwa.nama_terdakwa as terdakwa_nama',
                    'terdakwa_terdakwa.no_putusan as terdakwa_no_putusan',
                    'terdakwa_terdakwa.tgl_putusan as terdakwa_tgl_putusan',
                    'terdakwa_terdakwa.pasal as terdakwa_pasal',
                    'terdakwa_terdakwa.barang_bukti as terdakwa_barang_bukti',
                    'terdakwa_terdakwa.putusan_penahanan as terdakwa_putusan_penahanan',
                    'kasi_bb_pegawai.nama_pegawai as kasi_bb_nama',
                    'saksi1_pegawai.nama_pegawai as saksi1_nama',
                    'saksi2_pegawai.nama_pegawai as saksi2_nama'
                )->where('ba_23.status_ba23', 'sudah dieksekusi')
                ->whereBetween('tgl_ba23',[$start_date,$end_date])->get();
        } else {
            $dataFilter = ba_23::join('pegawai as jaksa_pegawai', 'jaksa_pegawai.id_pegawai', '=', 'ba_23.jaksa')
                ->join('terdakwa as terdakwa_terdakwa', 'terdakwa_terdakwa.id_terdakwa', '=', 'ba_23.terdakwa')
                ->join('pegawai as kasi_bb_pegawai', 'kasi_bb_pegawai.id_pegawai', '=', 'ba_23.kasi_bb')
                ->join('pegawai as saksi1_pegawai', 'saksi1_pegawai.id_pegawai', '=', 'ba_23.saksi1')
                ->join('pegawai as saksi2_pegawai', 'saksi2_pegawai.id_pegawai', '=', 'ba_23.saksi2')
                ->select(
                    'ba_23.*',
                    'jaksa_pegawai.nama_pegawai as jaksa_nama',
                    'terdakwa_terdakwa.nama_terdakwa as terdakwa_nama',
                    'terdakwa_terdakwa.no_putusan as terdakwa_no_putusan',
                    'terdakwa_terdakwa.tgl_putusan as terdakwa_tgl_putusan',
                    'terdakwa_terdakwa.pasal as terdakwa_pasal',
                    'terdakwa_terdakwa.barang_bukti as terdakwa_barang_bukti',
                    'terdakwa_terdakwa.putusan_penahanan as terdakwa_putusan_penahanan',
                    'kasi_bb_pegawai.nama_pegawai as kasi_bb_nama',
                    'saksi1_pegawai.nama_pegawai as saksi1_nama',
                    'saksi2_pegawai.nama_pegawai as saksi2_nama'
                )->where('ba_23.status_ba23', 'sudah dieksekusi')->get();
        }
        return view('rekapan_data_pemusnahan.cetak', compact('dataFilter', 'start_date', 'end_date'));

        // $start_date = $request->start_date;
        // $end_date = $request->end_date;
    
        // $data = ba_23::join('pegawai as jaksa_pegawai', 'jaksa_pegawai.id_pegawai', '=', 'ba_23.jaksa')
        //     ->join('terdakwa as terdakwa_terdakwa', 'terdakwa_terdakwa.id_terdakwa', '=', 'ba_23.terdakwa')
        //     ->join('pegawai as kasi_bb_pegawai', 'kasi_bb_pegawai.id_pegawai', '=', 'ba_23.kasi_bb')
        //     ->join('pegawai as saksi1_pegawai', 'saksi1_pegawai.id_pegawai', '=', 'ba_23.saksi1')
        //     ->join('pegawai as saksi2_pegawai', 'saksi2_pegawai.id_pegawai', '=', 'ba_23.saksi2')
        //     ->select(
        //         'ba_23.*',
        //         'terdakwa_terdakwa.nama_terdakwa as terdakwa_nama',
        //         'jaksa_pegawai.nama_pegawai as jaksa_nama',
        //         'kasi_bb_pegawai.nama_pegawai as kasi_bb_nama',
        //         'saksi1_pegawai.nama_pegawai as saksi1_nama',
        //         'saksi2_pegawai.nama_pegawai as saksi2_nama'
        //     )
        //     ->where('ba_23.status_ba23', 'sudah dieksekusi')
        //     ->whereDate('tgl_ba23','>=',$start_date)
        //     ->whereDate('tgl_ba23','<=',$end_date)
        //     ->get();
    
        // return view('rekapan_data_pemusnahan.index')->with('data', $data);
    }

    // public function print($start_date,$end_date){
    //     $dataFilter = ba_23::join('pegawai as jaksa_pegawai', 'jaksa_pegawai.id_pegawai', '=', 'ba_23.jaksa')
    //         ->join('terdakwa as terdakwa_terdakwa', 'terdakwa_terdakwa.id_terdakwa', '=', 'ba_23.terdakwa')
    //         ->join('pegawai as kasi_bb_pegawai', 'kasi_bb_pegawai.id_pegawai', '=', 'ba_23.kasi_bb')
    //         ->join('pegawai as saksi1_pegawai', 'saksi1_pegawai.id_pegawai', '=', 'ba_23.saksi1')
    //         ->join('pegawai as saksi2_pegawai', 'saksi2_pegawai.id_pegawai', '=', 'ba_23.saksi2')
    //         ->select(
    //             'ba_23.*',
    //             'terdakwa_terdakwa.nama_terdakwa as terdakwa_nama',
    //             'jaksa_pegawai.nama_pegawai as jaksa_nama',
    //             'kasi_bb_pegawai.nama_pegawai as kasi_bb_nama',
    //             'saksi1_pegawai.nama_pegawai as saksi1_nama',
    //             'saksi2_pegawai.nama_pegawai as saksi2_nama'
    //         )->where('ba_23.status_ba23', 'sudah dieksekusi')
    //         ->whereBetween('tgl_ba23',[$start_date,$end_date])->get();
    //     return view('rekapan_data_pemusnahan.cetak', compact('dataFilter'));
    // }

}
