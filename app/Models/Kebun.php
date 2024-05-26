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
    protected $fillable = ['kebun_luas', 'kebun_pohon',
                        'koordinat', 'pelanggan_id'];

    public function pelanggan(){
        return $this->belongsTo(Pelanggan::class, 'pelanggan_id', 'pelanggan_id');
    }

    public function demplotmaster(){
        return $this->hasMany(Demplotmaster::class, 'kebun_id', 'kebun_id');
    }
}
