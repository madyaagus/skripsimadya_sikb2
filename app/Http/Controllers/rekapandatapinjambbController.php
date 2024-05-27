<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\pegawai;
use App\Models\terdakwa;
use App\Models\peminjaman_bb;

use Mpdf\Mpdf;
use Carbon\Carbon;

class rekapandatapinjambbController extends Controller
{
    public function index(Request $request)
    {
        // Pencarian data
        // strlen yaitu mengecek apakah ada kata kunci atau tidak
        // or where jika kata kunci nya lebih dari satu jadi ga harus sesuai nim
        // else itu jika 
        // paginate() untuk menampilkan data ga semua nya dibagi gitu

        $jumlahbaris = 10;
            $data =peminjaman_bb::join('pegawai as jaksa_pegawai', 'jaksa_pegawai.id_pegawai', '=', 'peminjaman_bb.jaksa')
            ->join('terdakwa as terdakwa_terdakwa', 'terdakwa_terdakwa.id_terdakwa', '=', 'peminjaman_bb.terdakwa')
            ->join('pegawai as kasi_bb_pegawai', 'kasi_bb_pegawai.id_pegawai', '=', 'peminjaman_bb.kasi_bb')
            ->join('pegawai as petugas_bb_pegawai', 'petugas_bb_pegawai.id_pegawai', '=', 'peminjaman_bb.kasi_bb')
            ->select(
                'peminjaman_bb.*',
                'jaksa_pegawai.nama_pegawai as jaksa_nama',
                'terdakwa_terdakwa.nama_terdakwa as terdakwa_nama',
                'terdakwa_terdakwa.barang_bukti as terdakwa_barang_bukti',
                'petugas_bb_pegawai.nama_pegawai as petugas_bb_nama',
                'kasi_bb_pegawai.nama_pegawai as kasi_bb_nama',
            ) 
            ->orderBy('tgl_peminjaman', 'desc')
            ->paginate($jumlahbaris);
        
        return view ('rekapan_data_pinjam_bb.index')->with('data', $data);
    }

    public function filter(Request $request){
        $start_date = $request->start_date;
        $end_date = $request->end_date;

        if ($start_date && $end_date) {
            $dataFilter =peminjaman_bb::join('pegawai as jaksa_pegawai', 'jaksa_pegawai.id_pegawai', '=', 'peminjaman_bb.jaksa')
                ->join('terdakwa as terdakwa_terdakwa', 'terdakwa_terdakwa.id_terdakwa', '=', 'peminjaman_bb.terdakwa')
                ->join('pegawai as kasi_bb_pegawai', 'kasi_bb_pegawai.id_pegawai', '=', 'peminjaman_bb.kasi_bb')
                ->join('pegawai as petugas_bb_pegawai', 'petugas_bb_pegawai.id_pegawai', '=', 'peminjaman_bb.kasi_bb')
                ->select(
                    'peminjaman_bb.*',
                    'jaksa_pegawai.nama_pegawai as jaksa_nama',
                    'terdakwa_terdakwa.nama_terdakwa as terdakwa_nama',
                    'terdakwa_terdakwa.barang_bukti as terdakwa_barang_bukti',
                    'petugas_bb_pegawai.nama_pegawai as petugas_bb_nama',
                    'kasi_bb_pegawai.nama_pegawai as kasi_bb_nama',
                )
                ->whereBetween('tgl_peminjaman',[$start_date,$end_date])->get();
        } else {
            $dataFilter =peminjaman_bb::join('pegawai as jaksa_pegawai', 'jaksa_pegawai.id_pegawai', '=', 'peminjaman_bb.jaksa')
                ->join('terdakwa as terdakwa_terdakwa', 'terdakwa_terdakwa.id_terdakwa', '=', 'peminjaman_bb.terdakwa')
                ->join('pegawai as kasi_bb_pegawai', 'kasi_bb_pegawai.id_pegawai', '=', 'peminjaman_bb.kasi_bb')
                ->join('pegawai as petugas_bb_pegawai', 'petugas_bb_pegawai.id_pegawai', '=', 'peminjaman_bb.kasi_bb')
                ->select(
                    'peminjaman_bb.*',
                    'jaksa_pegawai.nama_pegawai as jaksa_nama',
                    'terdakwa_terdakwa.nama_terdakwa as terdakwa_nama',
                    'terdakwa_terdakwa.barang_bukti as terdakwa_barang_bukti',
                    'petugas_bb_pegawai.nama_pegawai as petugas_bb_nama',
                    'kasi_bb_pegawai.nama_pegawai as kasi_bb_nama',
                )->get();
        }
        return view('rekapan_data_pinjam_bb.cetak', compact('dataFilter', 'start_date', 'end_date'));

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
