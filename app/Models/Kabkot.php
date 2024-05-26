<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kabkot extends Model
{
    use HasFactory;

    protected $table = 'kabkot';
    protected $primaryKey = 'kabkot_id';
    protected $fillable = ['kabkot_name', 'provinsi_id'];

    public function kecamatan(){
        return $this->hasMany(Kecamatan::class, 'kabkot_id', 'kabkot_id');
    }

    public function provinsi(){
        return $this->belongsTo(Provinsi::class, 'provinsi_id', 'provinsi_id');
    }
}
