<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ba_20;
use App\Models\ba_23;
use App\Models\bensus;
use App\Models\peminjaman_bb;
use App\Models\terdakwa;

class SuksesLoginController extends Controller
{
    function index(){
        $jumlahba_20 = ba_20::count();
        $jumlahba_23 = ba_23::count();
        $jumlahbensus = bensus::count();
        $jumlahpeminjaman = peminjaman_bb::count();

        // Data untuk chart peminjaman berdasarkan status
        $statusCounts = [];

        for ($month = 1; $month <= 12; $month++) {
            $statusCounts[$month] = terdakwa::whereYear('tgl_penerimaan_bb', date('Y'))
                ->whereMonth('tgl_penerimaan_bb', $month)
                ->selectRaw('status_barang_bukti, count(*) as total')
                ->groupBy('status_barang_bukti')
                ->get()
                ->pluck('total', 'status_barang_bukti')
                ->toArray();
        }

        $chartData = [
            'labels' => [
                'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun',
                'Jul', 'Agus', 'Sep', 'Okt', 'Nov', 'Des'
            ],
            'data' => [
                'Tahap II' => [],
                'Proses Sidang' => [],
                'Restorative Justice' => [],
                'Inkrah' => [],
                'Banding' => [],
                'Kasasi' => [],   
            ]
        ];

        foreach ($chartData['labels'] as $index => $monthLabel) {
            foreach ($chartData['data'] as $status => $count) {
                $chartData['data'][$status][] = $statusCounts[$index + 1][$status] ?? 0;
            }
        }

        $data = [
            'jumlahba_20' => $jumlahba_20,
            'jumlahba_23' => $jumlahba_23,
            'jumlahbensus' => $jumlahbensus,
            'jumlahpeminjaman' => $jumlahpeminjaman,
            'chartTerdakwa' => $chartData,
        ];

        return view('menu.beranda', $data);
    }

    function stafbb(){
        $jumlahba_20 = ba_20::count();
        $jumlahba_23 = ba_23::count();
        $jumlahbensus = bensus::count();
        $jumlahpeminjaman = peminjaman_bb::count();

        // Data untuk chart peminjaman berdasarkan status
        $statusCounts = [];

        for ($month = 1; $month <= 12; $month++) {
            $statusCounts[$month] = terdakwa::whereYear('tgl_penerimaan_bb', date('Y'))
                ->whereMonth('tgl_penerimaan_bb', $month)
                ->selectRaw('status_barang_bukti, count(*) as total')
                ->groupBy('status_barang_bukti')
                ->get()
                ->pluck('total', 'status_barang_bukti')
                ->toArray();
        }

        $chartData = [
            'labels' => [
                'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun',
                'Jul', 'Agus', 'Sep', 'Okt', 'Nov', 'Des'
            ],
            'data' => [
                'Tahap II' => [],
                'Proses Sidang' => [],
                'Restorative Justice' => [],
                'Inkrah' => [],
                'Banding' => [],
                'Kasasi' => [],   
            ]
        ];

        foreach ($chartData['labels'] as $index => $monthLabel) {
            foreach ($chartData['data'] as $status => $count) {
                $chartData['data'][$status][] = $statusCounts[$index + 1][$status] ?? 0;
            }
        }

        $data = [
            'jumlahba_20' => $jumlahba_20,
            'jumlahba_23' => $jumlahba_23,
            'jumlahbensus' => $jumlahbensus,
            'jumlahpeminjaman' => $jumlahpeminjaman,
            'chartTerdakwa' => $chartData,
        ];

        return view('menu.beranda', $data);
    }
    
    function kasibb(){
        $jumlahba_20 = ba_20::count();
        $jumlahba_23 = ba_23::count();
        $jumlahbensus = bensus::count();
        $jumlahpeminjaman = peminjaman_bb::count();

        // Data untuk chart peminjaman berdasarkan status
        $statusCounts = [];

        for ($month = 1; $month <= 12; $month++) {
            $statusCounts[$month] = terdakwa::whereYear('tgl_penerimaan_bb', date('Y'))
                ->whereMonth('tgl_penerimaan_bb', $month)
                ->selectRaw('status_barang_bukti, count(*) as total')
                ->groupBy('status_barang_bukti')
                ->get()
                ->pluck('total', 'status_barang_bukti')
                ->toArray();
        }

        $chartData = [
            'labels' => [
                'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun',
                'Jul', 'Agus', 'Sep', 'Okt', 'Nov', 'Des'
            ],
            'data' => [
                'Tahap II' => [],
                'Proses Sidang' => [],
                'Restorative Justice' => [],
                'Inkrah' => [],
                'Banding' => [],
                'Kasasi' => [],   
            ]
        ];

        foreach ($chartData['labels'] as $index => $monthLabel) {
            foreach ($chartData['data'] as $status => $count) {
                $chartData['data'][$status][] = $statusCounts[$index + 1][$status] ?? 0;
            }
        }

        $data = [
            'jumlahba_20' => $jumlahba_20,
            'jumlahba_23' => $jumlahba_23,
            'jumlahbensus' => $jumlahbensus,
            'jumlahpeminjaman' => $jumlahpeminjaman,
            'chartTerdakwa' => $chartData,
        ];

        return view('menu.beranda', $data);
        
    }
    function kajari(){
        $jumlahba_20 = ba_20::count();
        $jumlahba_23 = ba_23::count();
        $jumlahbensus = bensus::count();
        $jumlahpeminjaman = peminjaman_bb::count();

        // Data untuk chart peminjaman berdasarkan status
        $statusCounts = [];

        for ($month = 1; $month <= 12; $month++) {
            $statusCounts[$month] = terdakwa::whereYear('tgl_penerimaan_bb', date('Y'))
                ->whereMonth('tgl_penerimaan_bb', $month)
                ->selectRaw('status_barang_bukti, count(*) as total')
                ->groupBy('status_barang_bukti')
                ->get()
                ->pluck('total', 'status_barang_bukti')
                ->toArray();
        }

        $chartData = [
            'labels' => [
                'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun',
                'Jul', 'Agus', 'Sep', 'Okt', 'Nov', 'Des'
            ],
            'data' => [
                'Tahap II' => [],
                'Proses Sidang' => [],
                'Restorative Justice' => [],
                'Inkrah' => [],
                'Banding' => [],
                'Kasasi' => [],   
            ]
        ];

        foreach ($chartData['labels'] as $index => $monthLabel) {
            foreach ($chartData['data'] as $status => $count) {
                $chartData['data'][$status][] = $statusCounts[$index + 1][$status] ?? 0;
            }
        }

        $data = [
            'jumlahba_20' => $jumlahba_20,
            'jumlahba_23' => $jumlahba_23,
            'jumlahbensus' => $jumlahbensus,
            'jumlahpeminjaman' => $jumlahpeminjaman,
            'chartTerdakwa' => $chartData,
        ];

        return view('menu.beranda', $data);
    }
    function jaksa(){
        $jumlahba_20 = ba_20::count();
        $jumlahba_23 = ba_23::count();
        $jumlahbensus = bensus::count();
        $jumlahpeminjaman = peminjaman_bb::count();

        // Data untuk chart peminjaman berdasarkan status
        $statusCounts = [];

        for ($month = 1; $month <= 12; $month++) {
            $statusCounts[$month] = terdakwa::whereYear('tgl_penerimaan_bb', date('Y'))
                ->whereMonth('tgl_penerimaan_bb', $month)
                ->selectRaw('status_barang_bukti, count(*) as total')
                ->groupBy('status_barang_bukti')
                ->get()
                ->pluck('total', 'status_barang_bukti')
                ->toArray();
        }

        $chartData = [
            'labels' => [
                'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun',
                'Jul', 'Agus', 'Sep', 'Okt', 'Nov', 'Des'
            ],
            'data' => [
                'Tahap II' => [],
                'Proses Sidang' => [],
                'Restorative Justice' => [],
                'Inkrah' => [],
                'Banding' => [],
                'Kasasi' => [],   
            ]
        ];

        foreach ($chartData['labels'] as $index => $monthLabel) {
            foreach ($chartData['data'] as $status => $count) {
                $chartData['data'][$status][] = $statusCounts[$index + 1][$status] ?? 0;
            }
        }

        $data = [
            'jumlahba_20' => $jumlahba_20,
            'jumlahba_23' => $jumlahba_23,
            'jumlahbensus' => $jumlahbensus,
            'jumlahpeminjaman' => $jumlahpeminjaman,
            'chartTerdakwa' => $chartData,
        ];

        return view('menu.beranda', $data);
    }

}
