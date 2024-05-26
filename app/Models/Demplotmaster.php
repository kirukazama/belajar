<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Demplotmaster extends Model
{
    use HasFactory;

    protected $table = 'demplot_master';
    protected $primaryKey = 'demplot_id';
    protected $fillable = [
        'no_bukti', 'tgl_bukti', 'pelanggan_id', 'kebun_id', 'demplot_luas',
        'demplot_pohon', 'demplot_tahapan', 'demplot_sesi', 'jenis_pupuk'
    ];

    public function kebun(){
        return $this->belongsTo(Kebun::class, 'kebun_id', 'kebun_id');
    }

    public function pelanggan(){
        return $this->belongsTo(Pelanggan::class, 'pelanggan_id', 'pelanggan_id');
    }

    public function demplotdetail(){
        return $this->hasMany(Demplotdetail::class, 'demplot_id', 'demplot_id');
    }
}
