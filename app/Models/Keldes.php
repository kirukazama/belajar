<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keldes extends Model
{
    use HasFactory;

    protected $table = 'keldes';
    protected $primaryKey = 'keldes_id';
    protected $fillable = ['keldes_name', 'kec_id'];

    public function pelanggan() {
        return $this->hasMany(Pelanggan::class, 'keldes_id', 'keldes_id');
    }

    public function kecamatan() {
        return $this->belongsTo(Kecamatan::class, 'kec_id', 'kec_id');
    }
}
