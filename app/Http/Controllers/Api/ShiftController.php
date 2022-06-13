<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Validator;
use App\Models\Shift;
use Illuminate\Support\Facades\DB;

class ShiftController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Shift = DB::table('shift')
            ->join('pegawai', 'shift.ID_PEGAWAI', '=', 'pegawai.ID_PEGAWAI')
            ->join('role', 'pegawai.ID_ROLE', '=' ,'role.ID_ROLE')
            ->join('jadwal', 'shift.ID_SHIFT', '=', 'jadwal.ID_SHIFT')
            ->select('pegawai.NAMA_PEGAWAI','pegawai.ID_PEGAWAI','role.NAMA_JABATAN', 'jadwal.*')
            ->get();


        if(count($Shift)>0){
            return response([
                'message' => 'Retrieve All Success',
                'data' =>$Shift
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
            'ID_PEGAWAI' => 'required',
            'ID_ROLE' => '',
        ]);
        
        if($validate->fails())
            return response(['message' => $validate->errors()],400);
        
        $Shift = Shift::create($storeData);
        return response([
            'message' => 'Add Shift Success',
            'data' =>$Shift
        ],200); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($ID_SHIFT)
    {
        $Shift = Shift::find($ID_SHIFT);
        
        if(!is_null($Shift)){
            return response([
                'message' => 'Mengambil Data Shift Berhasil',
                'data' =>$Shift
            ],200);
        }
        return response([
            'message' => 'Shift Tidak Ditemukan',
            'data' => null
        ],404);
    }

    public function update(Request $request, $ID_SHIFT,$ID_PEGAWAI)
    {
        // $Shift = DB::table('shift')
        //     ->select('shift.ID_SHIFT','shift.ID_PEGAWAI')
        //     ->where(['shift.ID_SHIFT' => $ID_SHIFT, 'shift.ID_PEGAWAI' => $ID_PEGAWAI])
        //     ->first();

        $Shift = Shift::find([$ID_SHIFT,$ID_PEGAWAI]);
        if(is_null($Shift)){
            return response([
                'message' => 'Shift Not Found',
                'data' => null
            ],404);
        }

        $updateData = $request->all();
        $validate = Validator::make($updateData,[
            
        ]);

        if($validate->fails())
            return response(['message' => $validate->errors()],400);

        $dataShift = DB::table('shift')
        ->where(['shift.ID_SHIFT' => $ID_SHIFT, 'shift.ID_PEGAWAI' => $ID_PEGAWAI])
        ->update(['ID_SHIFT' => $updateData['ID_SHIFT'], 'ID_PEGAWAI' => $updateData['ID_PEGAWAI']]);

        return response([
            'message' => 'Update Shift Berhasil',
        ],200);
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($ID_SHIFT)
    {
        $Shift = Shift::find($ID_SHIFT);
        if(is_null($Shift)){
            return response([
                'message' => 'Shift Not Found',
                'data' => null
            ],404);
        }

        if($Shift->delete()){
            return response([
                'message' => 'Delete Shift Success',
                'data' =>$Shift
            ],200);
        }
       
        return response([
            'message' => 'Delete Shift Failed',
            'data' => null,
        ],400);  
    }
}