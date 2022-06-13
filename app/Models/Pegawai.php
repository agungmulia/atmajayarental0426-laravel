<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    use HasFactory;

    protected $table = 'pegawai';
    protected $primaryKey = 'ID_PEGAWAI';
    public $timestamps = false;
    protected $fillable = [
        'ID_ROLE',
        'NAMA_PEGAWAI',
        'ALAMAT_PEGAWAI',
        'TANGGAL_LAHIR',
        'JENIS_KELAMIN',
        'NO_TELP_PEGAWAI',
        'EMAIL_PEGAWAI',
        'FOTO_PEGAWAI',
        'PASSWORD_PEGAWAI',
    ];

    

    public function Role()
    {
        return $this->hasOne('App\Models\Role');
    }


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