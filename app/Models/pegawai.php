<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pegawai extends Model
{
    use HasFactory;
    protected $fillable = ['nama_pegawai', 'id_pangkat', 'jabatan', 'status', 'nip', 'nrp', 'alamat', 'no_telp', 'foto'];
    protected $table = 'pegawai';
    protected $primaryKey = 'id_pegawai';

    // Pegawai.php (model Pegawai)
    // public function pangkat()
    // {
    //     return $this->belongsTo(pangkat::class);
    // }


    //jika tidak menggunakan timestamps
    // public $timestamps = false;
}
