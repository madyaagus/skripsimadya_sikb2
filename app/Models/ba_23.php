<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ba_23 extends Model
{
    use HasFactory;
    protected $fillable = ['hari', 'tgl_ba23', 'jaksa', 'terdakwa',
                            'kasi_bb', 'saksi1', 'saksi2', 'barang_bukti_ba23', 
                            'arsip', 'status_ba23'
                        ];
    protected $table = 'ba_23';
    protected $primaryKey = 'id_ba23';


    //jika tidak menggunakan timestamps
    // public $timestamps = false;
}
