<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'transaksi';
    protected $primaryKey = 'ID_TRANSAKSI';
    public $timestamps = false;
    protected $fillable = [
        'TANGGAL_MULAI_SEWA',
        'TANGGAL_SELESAI_SEWA',
        'TOTAL_BIAYA_SEWA',
        'STATUS_TRANSAKSI',
        'METODE_PEMBAYARAN',
        'ID_MOBIL',
        'ID_CUSTOMER',
        'ID_DRIVER',
        'KODE_PROMO',
        'RATING_AJR',
        'RATING_DRIVER',
    ];


    public function getCreatedAtAttribute(){
        if(!is_null($this->attributes['created_at'])){
            return Carbon::parse($this->attributes['created_at'])->format('Y-m-d H:i:s');
        }
    }
    
    public function getUpdatedAtAttribute(){
        if(!is_null($this->attributes['updated_at'])){
            return Carbon::parse($this->attributes['updated_at'])->format('Y-m-d H:i:s');
        }
    }
}