<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Uuid;
use Carbon\Carbon;
use App\Models\FormInput;
use App\Models\FileUpload;
use App\Models\question;
use App\Models\answer;
use App\Models\AnswerSave;
use Brian2694\Toastr\Facades\Toastr;

class TentangController extends Controller
{
    /** struktur organisasi */
    public function struktur()
    {
        return view('tentang.struktur');
    }

    public function sop()
    {
        return view('tentang.sop');
    }

    
}
