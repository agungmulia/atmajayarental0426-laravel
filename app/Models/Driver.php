<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    use HasFactory;

    protected $table = 'driver';
    protected $primaryKey = 'ID_DRIVER';
    public $timestamps = false;
    protected $fillable = [
        'NAMA_DRIVER',
        'ALAMAT_DRIVER',
        'TANGGAL_LAHIR_DRIVER',
        'FOTO_DRIVER',
        'JENIS_KELAMIN_DRIVER',
        'NO_TELP_DRIVER',
        'EMAIL_DRIVER',
        'PASSWORD_DRIVER',
        'SIM_DRIVER',
        'SKCK',
        'STATUS_KETERSEDIAAN',
        'SURAT_KESEHATAN',
        'SURAT_BEBAS_NAPZA',
        'BAHASA_ASING',
        'TANGGAL_SERVICE',
        'TARIF_DRIVER',
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