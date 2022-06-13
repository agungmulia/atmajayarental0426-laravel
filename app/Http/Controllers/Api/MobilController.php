<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Validator;
use App\Models\Mobil;
use Illuminate\Support\Facades\DB;

class MobilController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function mobilTersedia(){
        $Mobil = Mobil::where('STATUS_KETERSEDIAAN', 'Tersedia')->get();
        if(count($Mobil)>0){
            return response([
                'message' => 'Retrieve All Success',
                'data' =>$Mobil
            ],200);
        }
        return response([
            'message' => 'Empty',
            'data' => null
        ],400);
    }
    
    public function index(){
        $Mobil = Mobil::all();
        if(count($Mobil)>0){
            return response([
                'message' => 'Retrieve All Success',
                'data' =>$Mobil
            ],200);
        }
        return response([
            'message' => 'Empty',
            'data' => null
        ],400);
    }

    public function getBrosur()
    {
        $Mobil = DB::table('mobil')
            ->select('mobil.FOTO_MOBIL','mobil.NAMA_MOBIL','mobil.TIPE_MOBIL','mobil.JENIS_TRANSMISI_MOBIL','mobil.JENIS_BAHAN_BAKAR_MOBIL','mobil.WARNA_MOBIL','mobil.VOLUME_BAGASI_MOBIL','mobil.FASILITAS_MOBIL','mobil.HARGA_SEWA_HARIAN_MOBIL')
            ->get();
        
        if(!is_null($Mobil)){
            return response([
                'message' => 'Mengambil Data Mobil Berhasil',
                'data' =>$Mobil
            ],200);
        }
        return response([
            'message' => 'Mobil Tidak Ditemukan',
            'data' => null
        ],404);
    }

    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $storeData = $request->all();
        $validate = Validator::make($storeData, [
            'NAMA_MOBIL' => 'required',
            'TIPE_MOBIL' => 'required',
            'JENIS_TRANSMISI_MOBIL' => 'required',
            'JENIS_BAHAN_BAKAR_MOBIL' => 'required',
            'VOLUME_BAHAN_BAKAR'=>'required',
            'WARNA_MOBIL'=>'required',
            'VOLUME_BAGASI_MOBIL'=>'required',
            'FASILITAS_MOBIL'=>'required',
            'HARGA_SEWA_HARIAN_MOBIL'=>'required',
            'KAPASITAS_PENUMPANG'=>'required',
            'NO_STNK'=>'required|numeric',
            'KATEGORI_ASET'=>'required',
            'STATUS_KETERSEDIAAN'=>'required',
            'TANGGAL_SERVICE'=>'required',
            'FOTO_MOBIL'=>''
        ]);
        
        if($validate->fails())
            return response(['message' => $validate->errors()],400);

        $Mobil = Mobil::create($storeData);
        return response([
            'message' => 'Add Aset Success',
            'data' =>$Mobil
        ],200);      
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($ID_MOBIL){
        $Mobil = Mobil::find($ID_MOBIL);
        if(!is_null($Mobil)){
            return response([
                'message' => 'Mengambil Data Mobil Berhasil',
                'data' =>$Mobil
            ],200);
        }
        return response([
            'message' => 'Mobil Tidak Ditemukan',
            'data' => null
        ],404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$ID_MOBIL){
        $Mobil = Mobil::find($ID_MOBIL);
        if(is_null($Mobil)){
            return response([
                'message' => 'Mobil Not Found',
                'data' => null
            ],404);
        }

        $updateData = $request->all();
        $validate = Validator::make($updateData,[
            'NAMA_MOBIL' => 'required',
            'TIPE_MOBIL' => 'required',
            'JENIS_TRANSMISI_MOBIL' => 'required',
            'JENIS_BAHAN_BAKAR_MOBIL' => 'required',
            'VOLUME_BAHAN_BAKAR'=>'required',
            'WARNA_MOBIL'=>'required',
            'VOLUME_BAGASI_MOBIL'=>'required',
            'FASILITAS_MOBIL'=>'required',
            'HARGA_SEWA_HARIAN_MOBIL'=>'required',
            'KAPASITAS_PENUMPANG'=>'required',
            'NO_STNK'=>'required|numeric',
            'KATEGORI_ASET'=>'required',
            'STATUS_KETERSEDIAAN'=>'required',
            'TANGGAL_SERVICE'=>'required',

            'FOTO_MOBIL'=>''
        ]);

        if($validate->fails())
            return response(['message' => $validate->errors()],400);

        $Mobil->NAMA_MOBIL = $updateData['NAMA_MOBIL'];
        $Mobil->TIPE_MOBIL = $updateData['TIPE_MOBIL'];
        $Mobil->WARNA_MOBIL = $updateData['WARNA_MOBIL'];
        $Mobil->JENIS_TRANSMISI_MOBIL = $updateData['JENIS_TRANSMISI_MOBIL'];
        $Mobil->JENIS_BAHAN_BAKAR_MOBIL = $updateData['JENIS_BAHAN_BAKAR_MOBIL'];
        $Mobil->VOLUME_BAHAN_BAKAR = $updateData['VOLUME_BAHAN_BAKAR'];
        $Mobil->FASILITAS_MOBIL = $updateData['FASILITAS_MOBIL'];
        $Mobil->VOLUME_BAGASI_MOBIL = $updateData['VOLUME_BAGASI_MOBIL'];
        $Mobil->HARGA_SEWA_HARIAN_MOBIL = $updateData['HARGA_SEWA_HARIAN_MOBIL'];
        $Mobil->KAPASITAS_PENUMPANG = $updateData['KAPASITAS_PENUMPANG'];
        $Mobil->NO_STNK = $updateData['NO_STNK'];
        $Mobil->KATEGORI_ASET = $updateData['KATEGORI_ASET'];
        $Mobil->STATUS_KETERSEDIAAN = $updateData['STATUS_KETERSEDIAAN'];
        $Mobil->KAPASITAS_PENUMPANG = $updateData['KAPASITAS_PENUMPANG'];
        $Mobil->KONTRAK_MULAI = $updateData['KONTRAK_MULAI'];
        $Mobil->KONTRAK_SELESAI = $updateData['KONTRAK_SELESAI'];
        $Mobil->FOTO_MOBIL = $updateData['FOTO_MOBIL'];
        
        if($Mobil->save()){
            return response([
                'message' => 'Update Mobil Success',
                'data' => $Mobil
            ],200);
        }

        return response([
            'message' => 'Update Mobil failed',
            'data' => null,
        ],400);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($ID_MOBIL){
        $Mobil = Mobil::find($ID_MOBIL);
        if(is_null($Mobil)){
            return response([
                'message' => 'Mobil Not Found',
                'data' => null
            ],404);
        }

        if($Mobil->delete()){
            return response([
                'message' => 'Delete Mobil Success',
                'data' =>$Mobil
            ],200);
        }
       
        return response([
            'message' => 'Delete Mobil Failed',
            'data' => null,
        ],400);      
    }
}