<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Diskon extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'diskons';
    protected $fillable = [
        'id_buku',
        'diskon',
        'min_pembelian',
    ];

    public function buku(){
        return $this->hasOne(Buku::class, 'id','id_buku');
    }
    
}
