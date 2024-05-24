<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provinsi extends Model
{
    use HasFactory;
    protected $table = 'provinsi';
    protected $primaryKey = 'provinsi_id';
    protected $fillable = ['provinsi_name'];

    public function kabkot() {
        return $this->hasMany(Kabkot::class, 'provinsi_id', 'provinsi_id');
    }
}
