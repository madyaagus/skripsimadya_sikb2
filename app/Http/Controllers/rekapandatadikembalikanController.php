<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\pegawai;
use App\Models\terdakwa;
use App\Models\ba_20;

use Mpdf\Mpdf;
use Carbon\Carbon;

class rekapandatadikembalikanController extends Controller
{
    public function index(Request $request)
    {
    
        $jumlahbaris = 10;
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
            )    
            ->where('ba_20.status_ba20', 'sudah dieksekusi')
            ->orderBy('tanggal', 'desc')
            ->paginate($jumlahbaris);
        
        return view ('rekapan_data_dikembalikan.index')->with('data', $data);
    }

    public function filter(Request $request){
        $start_date = $request->start_date;
        $end_date = $request->end_date;

        if ($start_date && $end_date) {
            $dataFilter = ba_20::join('terdakwa as terdakwa_terdakwa', 'terdakwa_terdakwa.id_terdakwa', '=', 'ba_20.terdakwa')
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
                )  ->where('ba_20.status_ba20', 'sudah dieksekusi')
                ->whereBetween('tanggal',[$start_date,$end_date])->get();
        } else {
            $dataFilter = ba_20::join('terdakwa as terdakwa_terdakwa', 'terdakwa_terdakwa.id_terdakwa', '=', 'ba_20.terdakwa')
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
                )  ->where('ba_20.status_ba20', 'sudah dieksekusi')->get();
        }
        return view('rekapan_data_dikembalikan.cetak', compact('dataFilter', 'start_date', 'end_date'));

    }
}
