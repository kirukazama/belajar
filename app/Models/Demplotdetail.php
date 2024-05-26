<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Demplotdetail extends Model
{
    use HasFactory;
    
    protected $table = 'demplot_detail';
    protected $primaryKey = 'detail_id';
    protected $fillable = [
        'demplot_id', 'no_pohon', 'pohon_usia', 'jumlah_pelapah', 'jumlah_tandan', 'bakal_tandan', 'spiral', 'buah_dompet'
    ];

    public function demplotmaster(){
        return $this->belongsTo(Demplotmaster::class, 'demplot_id', 'demplot_id');
    }
}
