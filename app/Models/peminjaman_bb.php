<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class peminjaman_bb extends Model
{
    use HasFactory;
    protected $fillable = ['tgl_peminjaman', 'terdakwa', 'jaksa', 'petugas_bb', 'kasi_bb', 'jadwal_ambil',
                            'jadwal_kembali', 'dokumentasi_bon', 'status_peminjaman'
                          ];
    protected $table = 'peminjaman_bb';
    protected $primaryKey = 'id_peminjaman';


    //jika tidak menggunakan timestamps
    // public $timestamps = false;
}
