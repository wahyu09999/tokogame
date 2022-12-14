<?php

namespace App\Models;

use App\Models\Buku;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Detail_transaction extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'detail_transactions';
    protected $fillable = [
        'id_transaction',
        'id_buku',
        'jumlah',
        'sub_total',
        'id_diskon'
        
    ];

    public function transaction(){
        return $this->belongsTo(Transaction::class, 'id_transaction');
    }

    public function buku(){
        return $this->belongsTo(Buku::class, 'id_buku','id');
    }
    public function diskon(){
        return $this->belongsTo(Diskon::class, 'id_diskon','id');
    }
}
