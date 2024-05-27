<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pangkat extends Model
{
    use HasFactory;
    protected $fillable = ['nama_pangkat', 'keterangan_pangkat'];
    protected $table = 'pangkat';
    protected $primaryKey = 'id_pangkat';

    // public function pegawai()
    // {
    //     return $this->hasMany(pegawai::class);
    // }

    //jika tidak menggunakan timestamps
    // public $timestamps = false;
}
