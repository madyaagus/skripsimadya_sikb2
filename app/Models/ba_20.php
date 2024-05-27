<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ba_20 extends Model
{
    use HasFactory;
    protected $fillable = ['terdakwa', 'hari', 'tanggal', 'jaksa', 'dikembalikan',
                            'nama_penerima', 'pekerjaan_ba20', 'alamat_ba20', 'kasi_bb', 'saksi1',
                            'saksi2', 'barang_bukti_ba20', 'dokumentasi', 'arsip', 'status_ba20'
                        ];
    protected $table = 'ba_20';
    protected $primaryKey = 'id_ba20';


    //jika tidak menggunakan timestamps
    // public $timestamps = false;
}
