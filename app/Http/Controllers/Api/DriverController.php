<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Validator;
use App\Models\Driver;
use Illuminate\Support\Facades\DB;

class DriverController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Driver = Driver::all();
        if(count($Driver)>0){
            return response([
                'message' => 'Retrieve All Success',
                'data' =>$Driver
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
            'NAMA_DRIVER' => 'required',
            'ALAMAT_DRIVER' => 'required',
            'TANGGAL_LAHIR_DRIVER' => 'required',
            'JENIS_KELAMIN_DRIVER'=>'required',
            'NO_TELP_DRIVER'=>'required|numeric',
            'EMAIL_DRIVER'=>'required',
            'TARIF_DRIVER'=>'required|numeric',
            'BAHASA_ASING'=>'required',
            'PASSWORD_DRIVER'=>'required'
        ]);
        
        if($validate->fails())
            return response(['message' => $validate->errors()],400);

        $Driver = Driver::create($storeData);
        return response([
            'message' => 'Add Driver Success',
            'data' =>$Driver
        ],200);      
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($ID_DRIVER)
    {
        $Driver = Driver::find($ID_DRIVER);
        if(!is_null($Driver)){
            return response([
                'message' => 'Mengambil Data Driver Berhasil',
                'data' =>$Driver
            ],200);
        }
        return response([
            'message' => 'Driver Tidak Ditemukan',
            'data' => null
        ],404);
    }

    public function showMobile($ID_DRIVER)
    {
        $Driver = DB::table('driver')
            ->select('driver.NAMA_DRIVER','driver.ALAMAT_DRIVER','driver.EMAIL_DRIVER','driver.NO_TELP_DRIVER','driver.FOTO_DRIVER')
            ->where('driver.ID_DRIVER',$ID_DRIVER )
            ->get();
        if(!is_null($Driver)){
            return response([
                'message' => 'Mengambil Data Driver Berhasil',
                'data' =>$Driver
            ],200);
        }
        return response([
            'message' => 'Driver Tidak Ditemukan',
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
    public function update(Request $request, $ID_DRIVER)
    {
        $Driver = Driver::find($ID_DRIVER);
        if(is_null($Driver)){
            return response([
                'message' => 'Driver Not Found',
                'data' => null
            ],404);
        }

        $updateData = $request->all();
        $validate = Validator::make($updateData,[
            'NAMA_DRIVER' => 'required',
            'ALAMAT_DRIVER' => 'required',
            'TANGGAL_LAHIR_DRIVER' => 'required',
            'JENIS_KELAMIN_DRIVER'=>'required',
            'NO_TELP_DRIVER'=>'required|numeric',
            'EMAIL_DRIVER'=>'required',
            'TARIF_DRIVER'=>'required|numeric',
            'BAHASA_ASING'=>'required',
            'PASSWORD_DRIVER'=>'required'
        ]);

        if($validate->fails())
            return response(['message' => $validate->errors()],400);

        $Driver->NAMA_DRIVER = $updateData['NAMA_DRIVER'];
        $Driver->ALAMAT_DRIVER = $updateData['ALAMAT_DRIVER'];
        $Driver->TANGGAL_LAHIR_DRIVER = $updateData['TANGGAL_LAHIR_DRIVER'];
        $Driver->JENIS_KELAMIN_DRIVER = $updateData['JENIS_KELAMIN_DRIVER'];
        $Driver->BAHASA_ASING = $updateData['BAHASA_ASING'];
        $Driver->NO_TELP_DRIVER = $updateData['NO_TELP_DRIVER'];
        $Driver->EMAIL_DRIVER = $updateData['EMAIL_DRIVER'];
        $Driver->FOTO_DRIVER = $updateData['FOTO_DRIVER'];
        $Driver->PASSWORD_DRIVER = $updateData['PASSWORD_DRIVER'];
        $Driver->SIM_DRIVER = $updateData['SIM_DRIVER'];
        $Driver->SKCK = $updateData['SKCK'];
        $Driver->SURAT_KESEHATAN = $updateData['SURAT_KESEHATAN'];
        $Driver->SURAT_BEBAS_NAPZA = $updateData['SURAT_BEBAS_NAPZA'];
        $Driver->TARIF_DRIVER = $updateData['TARIF_DRIVER'];
        $Driver->STATUS_KETERSEDIAAN = $updateData['STATUS_KETERSEDIAAN'];

        
        if($Driver->save()){
            return response([
                'message' => 'Update Driver Success',
                'data' => $Driver
            ],200);
        }

        return response([
            'message' => 'Update Driver failed',
            'data' => null,
        ],400);
    }

    public function updateMobile($ID_DRIVER,Request $request)
    {
        $Driver = Driver::find($ID_DRIVER);
        $DriverResponse = DB::table('driver')
            ->select('driver.NAMA_DRIVER','driver.ALAMAT_DRIVER','driver.EMAIL_DRIVER','driver.NO_TELP_DRIVER','driver.FOTO_DRIVER')
            ->where('driver.ID_DRIVER',$ID_DRIVER )
            ->get();
        if(is_null($Driver)){
            return response([
                'message' => 'Driver Not Found',
                'data' => null
            ],404);
        }

        $updateData = $request->all();
        $validate = Validator::make($updateData,[
            'NAMA_DRIVER' => 'required',
            'ALAMAT_DRIVER' => 'required',
            'NO_TELP_DRIVER'=>'required|numeric',
            'EMAIL_DRIVER'=>'required',
            'PASSWORD_DRIVER'=>'required'
        ]);

        if($validate->fails())
            return response(['message' => $validate->errors()],400);

        $Driver->NAMA_DRIVER = $updateData['NAMA_DRIVER'];
        $Driver->ALAMAT_DRIVER = $updateData['ALAMAT_DRIVER'];
        $Driver->NO_TELP_DRIVER = $updateData['NO_TELP_DRIVER'];
        $Driver->EMAIL_DRIVER = $updateData['EMAIL_DRIVER'];
        $Driver->FOTO_DRIVER = $updateData['FOTO_DRIVER'];
        $Driver->PASSWORD_DRIVER = $updateData['PASSWORD_DRIVER'];
        if($Driver->save()){
            return response([
                'message' => 'Update Driver Success',
                'data' => $DriverResponse
            ],200);
        }

        return response([
            'message' => 'Update Driver failed',
            'data' => null,
        ],400);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($ID_DRIVER)
    {
        $Driver = Driver::find($ID_DRIVER);
        if(is_null($Driver)){
            return response([
                'message' => 'Driver Not Found',
                'data' => null
            ],404);
        }

        if($Driver->delete()){
            return response([
                'message' => 'Delete Driver Success',
                'data' =>$Driver
            ],200);
        }
       
        return response([
            'message' => 'Delete Driver Failed',
            'data' => null,
        ],400);  
    }
}