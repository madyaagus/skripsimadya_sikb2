<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\pegawai;
use App\Models\terdakwa;
use App\Models\bensus;

use Mpdf\Mpdf;
use Carbon\Carbon;

class rekapandatabensusController extends Controller
{
    public function index(Request $request)
    {
    
        $jumlahbaris = 10;
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
            )      
            ->where('bensus.status_bensus', 'sudah dieksekusi')
            ->orderBy('tgl_bensus', 'desc')
            ->paginate($jumlahbaris);
        
        return view ('rekapan_data_bensus.index')->with('data', $data);
    }

    public function filter(Request $request){
        $start_date = $request->start_date;
        $end_date = $request->end_date;

        if ($start_date && $end_date) {
            $dataFilter = bensus::join('pegawai as jaksa_pegawai', 'jaksa_pegawai.id_pegawai', '=', 'bensus.jaksa')
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
            ) ->where('bensus.status_bensus', 'sudah dieksekusi')
            ->whereBetween('tgl_bensus',[$start_date,$end_date])->get();
        } else {
            $dataFilter = bensus::join('pegawai as jaksa_pegawai', 'jaksa_pegawai.id_pegawai', '=', 'bensus.jaksa')
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
            ) ->where('bensus.status_bensus', 'sudah dieksekusi')->get();
        }
        return view('rekapan_data_bensus.cetak', compact('dataFilter', 'start_date', 'end_date'));

    }
}
