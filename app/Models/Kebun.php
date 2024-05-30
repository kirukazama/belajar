<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kebun extends Model
{
    use HasFactory;

    use HasFactory;

    protected $table = 'kebun';
    protected $primaryKey = 'kebun_id';
    protected $fillable = ['kebun_luas', 'kebun_pohon', 'kebun_alamat',
                        'keldes_id', 'koordinat', 'pelanggan_id'];

    public function pelanggan(){
        return $this->belongsTo(Pelanggan::class, 'pelanggan_id', 'pelanggan_id');
    }

    public function demplotmaster(){
        return $this->hasMany(Demplotmaster::class, 'kebun_id', 'kebun_id');
    }

    public function keldes() {
        return $this->belongsTo(Keldes::class, 'keldes_id', 'keldes_id');
    }
}
