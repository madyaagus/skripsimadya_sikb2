<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class bensus extends Model
{
    use HasFactory;
    protected $fillable = ['hari', 'tgl_bensus', 'jaksa', 'terdakwa',
                            'jumlah_uang', 'keterangan_uang', 'bendahara', 
                            'tujuan_setoran', 'bank_setoran', 'alamat_bank', 
                            'saksi1', 'saksi2', 'arsip', 'status_bensus'
                        ];
    protected $table = 'bensus';
    protected $primaryKey = 'id_bensus';


    //jika tidak menggunakan timestamps
    // public $timestamps = false;
}
