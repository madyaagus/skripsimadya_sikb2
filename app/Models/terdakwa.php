<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class terdakwa extends Model
{
    use HasFactory;
    protected $fillable = ['nama_terdakwa', 'tempat_lahir', 'tgl_lahir', 'umur', 'jenis_kelamin', 'kebangsaan', 
                            'agama', 'alamat_terdakwa', 'pekerjaan', 'reg_perkara', 'reg_bukti', 'tgl_penyitaan', 
                            'tgl_penerimaan_bb', 'pasal', 'jaksa1', 'jaksa2', 'nama_penyidik', 'pangkat_nrp_penyidik',
                            'print_p48', 'tgl_p48', 'no_putusan', 'tgl_putusan', 'barang_bukti', 'status_barang_bukti',
                            'status_eksekusi', 'keterangan_eksekusi', 'keterangan_putusan', 'petugas_bb', 'putusan_penahanan'
                        ];
    protected $table = 'terdakwa';
    protected $primaryKey = 'id_terdakwa';

    public function scopeSudahInkrah($data)
    {
        return $data->where('status_barang_bukti', 'inkrah');
    }

    public function scopeBelumInkrah($data)
    {
        return $data->whereIn('status_barang_bukti', ['tahap II', 'proses sidang', 'banding', 'kasasi']);
    }


    //jika tidak menggunakan timestamps
    // public $timestamps = false;
}
