<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kecamatan extends Model
{
    use HasFactory;

    protected $table = 'kecamatan';
    protected $primaryKey = 'kec_id';
    protected $fillable = ['kec_name','kabkot_id'];

    public function keldes() {
        return $this->hasMany(Keldes::class, 'kec_id', 'kec_id');
    }

    public function kabkot() {
        return $this->belongsTo(Kabkot::class, 'kabkot_id', 'kabkot_id');
    }
}
