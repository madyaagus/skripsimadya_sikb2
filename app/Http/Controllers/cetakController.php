<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\pegawai;
use App\Models\terdakwa;
use App\Models\ba_20;

class cetakController extends Controller
{
    public function cetakba20()
    {
        $data['terdakwa'] = terdakwa::all();
        $data['jaksa'] = pegawai::where('status', 'jaksa')->get();
        $data['kasi_bb'] = pegawai::where('status', 'tata usaha')->get();
        $data['saksi1'] = pegawai::all();
        $data['saksi2'] = pegawai::all();
    
        // Fetch the data you need for printing
    
        // You can return a view for the print or generate a PDF here
        // Example using the existing view:
        return view('ba20.cetakba20', $data);
    }
}
