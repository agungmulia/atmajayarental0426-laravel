<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Validator;
use App\Models\Pegawai;
use Illuminate\Support\Facades\DB;

class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Pegawai = Pegawai::all();

        $Pegawai = DB::table('pegawai')
            ->join('role', 'pegawai.ID_ROLE', '=', 'role.ID_ROLE')// joining the contacts table , where user_id and contact_user_id are same
            ->select('pegawai.*', 'role.NAMA_JABATAN')
            ->get();

        if(count($Pegawai)>0){
            return response([
                'message' => 'Retrieve All Success',
                'data' =>$Pegawai
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
            'NAMA_PEGAWAI' => 'required',
            'ID_ROLE' => '',
            'ALAMAT_PEGAWAI' => 'required',
            'TANGGAL_LAHIR' => 'required',
            'JENIS_KELAMIN'=>'required',
            'NO_TELP_PEGAWAI'=>'required',
            'EMAIL_PEGAWAI'=>'required',
            'FOTO_PEGAWAI'=>'',
            'PASSWORD_PEGAWAI'=>'required'
        ]);
        
        if($validate->fails())
            return response(['message' => $validate->errors()],400);

        $Pegawai = Pegawai::create($storeData);
        return response([
            'message' => 'Add Pegawai Success',
            'data' =>$Pegawai
        ],200);      
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($ID_PEGAWAI)
    {
        
        $Pegawai = Pegawai::find($ID_PEGAWAI);
        
        if(!is_null($Pegawai)){
            return response([
                'message' => 'Mengambil Data Pegawai Berhasil',
                'data' =>$Pegawai
            ],200);
        }
        return response([
            'message' => 'Pegawai Tidak Ditemukan',
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
    public function update(Request $request, $ID_PEGAWAI)
    {
        $Pegawai = Pegawai::find($ID_PEGAWAI);
        if(is_null($Pegawai)){
            return response([
                'message' => 'Pegawai Not Found',
                'data' => null
            ],404);
        }

        $updateData = $request->all();
        $validate = Validator::make($updateData,[
            'NAMA_PEGAWAI' => 'required',
            'ID_ROLE' => '',
            'ALAMAT_PEGAWAI' => 'required',
            'TANGGAL_LAHIR' => 'required',
            'JENIS_KELAMIN'=>'required',
            'EMAIL_PEGAWAI'=>'required',
            'FOTO_PEGAWAI'=>'',
            'PASSWORD_PEGAWAI'=>'required'
        ]);

        if($validate->fails())
            return response(['message' => $validate->errors()],400);

        $Pegawai->NAMA_PEGAWAI = $updateData['NAMA_PEGAWAI'];
        $Pegawai->ID_ROLE = $updateData['ID_ROLE'];
        $Pegawai->ALAMAT_PEGAWAI = $updateData['ALAMAT_PEGAWAI'];
        $Pegawai->TANGGAL_LAHIR = $updateData['TANGGAL_LAHIR'];
        $Pegawai->JENIS_KELAMIN = $updateData['JENIS_KELAMIN'];
        $Pegawai->NO_TELP_PEGAWAI = $updateData['NO_TELP_PEGAWAI'];
        $Pegawai->EMAIL_PEGAWAI = $updateData['EMAIL_PEGAWAI'];
        $Pegawai->FOTO_PEGAWAI = $updateData['FOTO_PEGAWAI'];
        $Pegawai->PASSWORD_PEGAWAI = $updateData['PASSWORD_PEGAWAI'];
        
        if($Pegawai->save()){
            return response([
                'message' => 'Update Pegawai Success',
                'data' => $Pegawai
            ],200);
        }

        return response([
            'message' => 'Update Pegawai failed',
            'data' => null,
        ],400);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($ID_PEGAWAI)
    {
        $Pegawai = Pegawai::find($ID_PEGAWAI);
        if(is_null($Pegawai)){
            return response([
                'message' => 'Pegawai Not Found',
                'data' => null
            ],404);
        }

        if($Pegawai->delete()){
            return response([
                'message' => 'Delete Pegawai Success',
                'data' =>$Pegawai
            ],200);
        }
       
        return response([
            'message' => 'Delete Pegaawai Failed',
            'data' => null,
        ],400);  
    }
}