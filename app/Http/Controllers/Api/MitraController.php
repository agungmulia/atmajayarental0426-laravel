<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Validator;
use App\Models\Mitra;
use Illuminate\Support\Facades\DB;

class MitraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Mitra = Mitra::all();

        if(count($Mitra)>0){
            return response([
                'message' => 'Retrieve All Success',
                'data' =>$Mitra
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
            'NAMA_MITRA'=>'required',
            'ALAMAT_MITRA'=>'required',
            'NO_TELEPON_MITRA'=>'required',
            'NO_KTP_MITRA'=>'required|numeric',
        ]);
        
        if($validate->fails())
            return response(['message' => $validate->errors()],400);

        $Mitra = Mitra::create($storeData);
        return response([
            'message' => 'Add Mitra Success',
            'data' =>$Mitra
        ],200);      
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($ID_MITRA)
    {
        
        $Mitra = Mitra::find($ID_MITRA);
        
        if(!is_null($Mitra)){
            return response([
                'message' => 'Mengambil Data Mitra Berhasil',
                'data' =>$Mitra
            ],200);
        }
        return response([
            'message' => 'Mitra Tidak Ditemukan',
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
    public function update(Request $request, $ID_MITRA)
    {
        $Mitra = Mitra::find($ID_MITRA);
        if(is_null($Mitra)){
            return response([
                'message' => 'Mitra Not Found',
                'data' => null
            ],404);
        }

        $updateData = $request->all();
        $validate = Validator::make($updateData,[
            'NAMA_MITRA'=>'required',
            'ALAMAT_MITRA'=>'required',
            'NO_TELEPON_MITRA'=>'required',
            'NO_KTP_MITRA'=>'required|numeric',
        ]);

        if($validate->fails())
            return response(['message' => $validate->errors()],400);

        $Mitra->NAMA_MITRA = $updateData['NAMA_MITRA'];
        $Mitra->ALAMAT_MITRA = $updateData['ALAMAT_MITRA'];
        $Mitra->NO_TELEPON_MITRA = $updateData['NO_TELEPON_MITRA'];
        $Mitra->NO_KTP_MITRA = $updateData['NO_KTP_MITRA'];
        
        if($Mitra->save()){
            return response([
                'message' => 'Update Mitra Success',
                'data' => $Mitra
            ],200);
        }

        return response([
            'message' => 'Update Mitra failed',
            'data' => null,
        ],400);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($ID_MITRA)
    {
        $Mitra = Mitra::find($ID_MITRA);
        if(is_null($Mitra)){
            return response([
                'message' => 'Mitra Not Found',
                'data' => null
            ],404);
        }

        if($Mitra->delete()){
            return response([
                'message' => 'Delete Mitra Success',
                'data' =>$Mitra
            ],200);
        }
       
        return response([
            'message' => 'Delete Mitra Failed',
            'data' => null,
        ],400);  
    }
}