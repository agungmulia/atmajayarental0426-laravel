<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Validator;
use App\Models\Promo;
use Illuminate\Support\Facades\DB;

class PromoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Promo = Promo::all();

        if(count($Promo)>0){
            return response([
                'message' => 'Retrieve All Success',
                'data' =>$Promo
            ],200);
        }
        return response([
            'message' => 'Empty',
            'data' => null
        ],400);
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
    public function store(Request $request)
    {
        $storeData = $request->all();
        $validate = Validator::make($storeData, [
            'JENIS_PROMO' => 'required',
            'KODE_PROMO' => '',
            'KETERANGAN_PROMO' => 'required',
            'PERSENTASE' => 'numeric',
        ]);
        
        if($validate->fails())
            return response(['message' => $validate->errors()],400);

        $Promo = Promo::create($storeData);
        return response([
            'message' => 'Add Promo Success',
            'data' =>$Promo
        ],200);      
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($KODE_PROMO)
    {
        
        $Promo = Promo::find($KODE_PROMO);
        
        if(!is_null($Promo)){
            return response([
                'message' => 'Mengambil Data Promo Berhasil',
                'data' =>$Promo
            ],200);
        }
        return response([
            'message' => 'Promo Tidak Ditemukan',
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
    public function update(Request $request, $KODE_PROMO)
    {
        $Promo = Promo::find($KODE_PROMO);
        if(is_null($Promo)){
            return response([
                'message' => 'Promo Not Found',
                'data' => null
            ],404);
        }

        $updateData = $request->all();
        $validate = Validator::make($updateData,[
            'JENIS_PROMO' => 'required',
            'KODE_PROMO' => '',
            'KETERANGAN_PROMO' => 'required',
            'PERSENTASE' => 'numeric',
        ]);

        if($validate->fails())
            return response(['message' => $validate->errors()],400);

        $Promo->KODE_PROMO = $updateData['KODE_PROMO'];
        $Promo->JENIS_PROMO = $updateData['JENIS_PROMO'];
        $Promo->KETERANGAN_PROMO = $updateData['KETERANGAN_PROMO'];
        $Promo->PERSENTASE = $updateData['PERSENTASE'];
        
        if($Promo->save()){
            return response([
                'message' => 'Update Promo Success',
                'data' => $Promo
            ],200);
        }

        return response([
            'message' => 'Update Promo failed',
            'data' => null,
        ],400);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($KODE_PROMO)
    {
        $Promo = Promo::find($KODE_PROMO);
        if(is_null($Promo)){
            return response([
                'message' => 'Promo Not Found',
                'data' => null
            ],404);
        }

        if($Promo->delete()){
            return response([
                'message' => 'Delete Promo Success',
                'data' =>$Promo
            ],200);
        }
       
        return response([
            'message' => 'Delete Promo Failed',
            'data' => null,
        ],400);  
    }
}