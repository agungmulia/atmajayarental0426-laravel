<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Validator;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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


        //  $id = IdGenerator::generate(['customer' => 'ID_TRANSAKSI', 'length' => 1]);
        
  
        $storeData = $request->all();
        $storeData['role'] = 'customer';
        
        $validate = Validator::make($storeData, [
            'NAMA_CUSTOMER' => 'required',
            'ALAMAT_CUSTOMER' => 'required',
            'TANGGAL_LAHIR' => 'required',
            'JENIS_KELAMIN'=>'required',
            'NO_TELP_CUSTOMER'=>'required|numeric',
            'EMAIL_CUSTOMER'=>'required|unique:customer',
            'FOTO_CUSTOMER'=>'',
            'KTP_CUSTOMER'=>'required',
            'PASSWORD_CUSTOMER'=>'required'
        ]);
        
        if($validate->fails())
            return response(['message' => $validate->errors()],400);

        $storeData['password'] = bcrypt($request->password);
        $user = User::create($storeData);

        $Customer = Customer::create($storeData);
        return response([
            'message' => 'Add Customer Success',
            'data' =>$Customer
        ],200);   
    }

    public function getCustomerByEmail($EMAIL_CUSTOMER)
    {
        $Transaksi = DB::table('customer')
            ->select('customer.NAMA_CUSTOMER','customer.FOTO_CUSTOMER','customer.ID_CUSTOMER','customer.ALAMAT_CUSTOMER','customer.EMAIL_CUSTOMER')
            ->where('customer.EMAIL_CUSTOMER',$EMAIL_CUSTOMER)
            ->get();
        
        if(!is_null($Transaksi)){
            return response([
                'message' => 'Mengambil Data Customer Berhasil',
                'data' =>$Transaksi
            ],200);
        }
        return response([
            'message' => 'Transaksi Tidak Ditemukan',
            'data' => null
        ],404);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}