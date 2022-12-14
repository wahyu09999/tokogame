<?php

namespace App\Models;

use App\Models\Buku;
use App\Models\Diskon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Chart extends Model
{
    use HasFactory;

    protected $table = 'charts';
    protected $fillable = [
        'id_buku',
        'jumlah',
        'sub_total',
        'id_diskon'
    ];

    public function buku(){
        return $this->hasOne(Buku::class, 'id','id_buku');
    }
    public function diskon(){
        return $this->hasOne(Diskon::class, 'id','id_diskon');
    }
}
