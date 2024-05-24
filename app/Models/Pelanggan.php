<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    use HasFactory;

    protected $table = 'pelanggan';
    protected $primaryKey = 'pelanggan_id';
    protected $fillable = ['pelanggan_name', 'pelanggan_alamat',
                        'keldes_id', 'no_telp', 'perusahaan_name',
                        'pimpinan_name','perusahaan_telp'];

    
    public function keldes() {
        return $this->belongsTo(Keldes::class, 'keldes_id', 'keldes_id');
    }

    // public function kecamatan() {
    //     return $this->belongsTo(Kecamatan::class, 'kec_id', 'kec_id');
    // }
}
