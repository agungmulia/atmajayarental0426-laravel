<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $table = 'customer';
    protected $primaryKey = 'ID_CUSTOMER';
    public $timestamps = false;
    protected $fillable = [
        'ID_ROLE',
        'NAMA_CUSTOMER',
        'ALAMAT_CUSTOMER',
        'TANGGAL_LAHIR',
        'JENIS_KELAMIN',
        'NO_TELP_CUSTOMER',
        'EMAIL_CUSTOMER',
        'FOTO_CUSTOMER',
        'PASSWORD_CUSTOMER',
        'SIM_CUSTOMER',
        'KTP_CUSTOMER'
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