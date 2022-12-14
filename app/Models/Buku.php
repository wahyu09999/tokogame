<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Buku extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'bukus';
    protected $fillable = [
        'id_kategori',
        'judul',
        'pengarang',
        'penerbit',
        'tahun_terbit',
        'jumlah_buku',
        'harga',
        'deskripsi',
        'gambar'
    ];

    public function kategori(){
        return $this->hasMany(Kategori::class, 'id','id_kategori');
    }
}
