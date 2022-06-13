<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mobil extends Model
{
    use HasFactory;

    protected $table = 'mobil';
    protected $primaryKey = 'ID_MOBIL';
    public $timestamps = false;
    protected $fillable = [
        'ID_MITRA',
        'NAMA_MOBIL',
        'TIPE_MOBIL',
        'JENIS_TRANSMISI_MOBIL',
        'JENIS_BAHAN_BAKAR_MOBIL',
        'VOLUME_BAHAN_BAKAR',
        'WARNA_MOBIL',
        'VOLUME_BAGASI_MOBIL',
        'FASILITAS_MOBIL',
        'HARGA_SEWA_HARIAN_MOBIL',
        'KAPASITAS_PENUMPANG',
        'NO_STNK',
        'KATEGORI_ASET',
        'STATUS_KETERSEDIAAN',
        'TANGGAL_SERVICE',
        'KONTRAK_MULAI',
        'KONTRAK_SELESAI',
        'FOTO_MOBIL'
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