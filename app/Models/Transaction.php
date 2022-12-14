<?php

namespace App\Models;

use App\Models\User;
use App\Models\Detail_transaction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaction extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'transactions';
    protected $fillable = [
        'id_transaction',
        'tgl_transaction',
        'jam_transaction',
        'total',
        'bayar',
        'item',
        'kembali',
        'id_user',

    ];

    public function detail_transaction()
    {
        return $this->hasMany(Detail_transaction::class, 'id_transaction');
    }
    public function user(){
        return $this->hasMany(User::class, 'id','id_user');
    }
}
