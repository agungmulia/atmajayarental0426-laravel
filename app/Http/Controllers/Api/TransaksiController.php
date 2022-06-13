<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Carbon\Carbon;
use Validator;
use App\Models\Transaksi;
use App\Models\Mobil;
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Transaksi = DB::table('transaksi')
            ->join('mobil', 'transaksi.ID_MOBIL', '=', 'mobil.ID_MOBIL')
            ->join('customer', 'transaksi.ID_CUSTOMER', '=', 'customer.ID_CUSTOMER')
            ->leftjoin('driver', 'transaksi.ID_DRIVER', '=' ,'driver.ID_DRIVER')
            ->leftjoin('promo', 'transaksi.KODE_PROMO', '=', 'promo.KODE_PROMO')
            ->select('driver.NAMA_DRIVER','customer.NAMA_CUSTOMER','transaksi.METODE_PEMBAYARAN','transaksi.ID_TRANSAKSI','transaksi.STATUS_TRANSAKSI','transaksi.TANGGAL_MULAI_SEWA','transaksi.TOTAL_PEMBAYARAN','transaksi.TANGGAL_SELESAI_SEWA','promo.KODE_PROMO','promo.PERSENTASE','promo.KETERANGAN_PROMO','mobil.NAMA_MOBIL','mobil.FOTO_MOBIL','mobil.HARGA_SEWA_HARIAN_MOBIL')
            ->get();

            if(count($Transaksi)>0){
                return response([
                    'message' => 'Retrieve All Success',
                    'data' =>$Transaksi
                ],200);
            }
            return response([
                'message' => 'Empty',
                'data' => null
            ],400);
    }

    public function jumlahPendapatan()
    {
        $Transaksi = DB::table('transaksi')
            ->join('mobil', 'transaksi.ID_MOBIL', '=', 'mobil.ID_MOBIL')
            ->select('mobil.FOTO_MOBIL','mobil.TIPE_MOBIL','mobil.NAMA_MOBIL',DB::raw('COUNT(transaksi.ID_MOBIL) as JUMLAH_PEMINJAMAN'),DB::raw('SUM(mobil.HARGA_SEWA_HARIAN_MOBIL) as PENDAPATAN'))
            ->groupBy('mobil.TIPE_MOBIL','mobil.NAMA_MOBIL','mobil.FOTO_MOBIL')
            ->orderBydesc(DB::raw('SUM(mobil.HARGA_SEWA_HARIAN_MOBIL)'))
            ->get();

            if(count($Transaksi)>0){
                return response([
                    'message' => 'Retrieve All Success',
                    'data' =>$Transaksi
                ],200);
            }
            return response([
                'message' => 'Empty',
                'data' => null
            ],400);
    }

    public function topDriver()
    {
        $Transaksi = DB::table('transaksi')
            ->join('driver', 'transaksi.ID_DRIVER', '=', 'driver.ID_DRIVER')
            ->select('driver.FOTO_DRIVER','driver.ID_DRIVER','driver.NAMA_DRIVER',DB::raw('COUNT(transaksi.ID_DRIVER) as JUMLAH_TRANSAKSI'),DB::raw('AVG(transaksi.RATING_DRIVER) as RERATA_RATING'))
            ->groupBy('driver.ID_DRIVER','driver.NAMA_DRIVER','driver.FOTO_DRIVER')
            ->limit(5)
            ->orderBydesc(DB::raw('COUNT(transaksi.ID_DRIVER)'))
            ->get();

            if(count($Transaksi)>0){
                return response([
                    'message' => 'Retrieve All Success',
                    'data' =>$Transaksi
                ],200);
            }
            return response([
                'message' => 'Empty',
                'data' => null
            ],400);
    }

    public function topCustomer()
    {
        $Transaksi = DB::table('transaksi')
            ->join('customer', 'transaksi.ID_CUSTOMER', '=', 'customer.ID_CUSTOMER')
            ->select('customer.FOTO_CUSTOMER','customer.ID_CUSTOMER','customer.NAMA_CUSTOMER','customer.ALAMAT_CUSTOMER',DB::raw('COUNT(transaksi.ID_CUSTOMER) as JUMLAH_TRANSAKSI'))
            ->groupBy('customer.ID_CUSTOMER','customer.NAMA_CUSTOMER','customer.FOTO_CUSTOMER','customer.ALAMAT_CUSTOMER')
            ->limit(5)
            ->orderBydesc(DB::raw('COUNT(transaksi.ID_CUSTOMER)'))
            ->get();

            if(count($Transaksi)>0){
                return response([
                    'message' => 'Retrieve All Success',
                    'data' =>$Transaksi
                ],200);
            }
            return response([
                'message' => 'Empty',
                'data' => null
            ],400);
    }

    public function promoTransaksi()
    {
        $Transaksi = DB::table('transaksi')
            ->rightjoin('promo', 'transaksi.KODE_PROMO', '=', 'promo.KODE_PROMO')
            ->select('promo.*')
            ->get();

            if(count($Transaksi)>0){
                return response([
                    'message' => 'Retrieve All Success',
                    'data' =>$Transaksi
                ],200);
            }
            return response([
                'message' => 'Empty',
                'data' => null
            ],400);
    }

    public function pendapatan()
    {
        $Transaksi = DB::table('transaksi')
            ->join('mobil', 'transaksi.ID_MOBIL', '=', 'mobil.ID_MOBIL')
            ->join('customer', 'transaksi.ID_CUSTOMER', '=', 'customer.ID_CUSTOMER')
            ->select('mobil.NAMA_MOBIL','customer.FOTO_CUSTOMER','customer.NAMA_CUSTOMER',DB::raw('COUNT(transaksi.ID_TRANSAKSI) as JUMLAH_TRANSAKSI'),DB::raw('SUM(transaksi.TOTAL_PEMBAYARAN) as PENDAPATAN'),DB::raw('IF(transaksi.ID_DRIVER IS NOT NULL,"Peminjaman Mobil + Driver","Peminjaman Mobil") as JENIS_TRANSAKSI'))
            ->groupBy('transaksi.ID_CUSTOMER','transaksi.ID_MOBIL')
            ->get();

            if(count($Transaksi)>0){
                return response([
                    'message' => 'Retrieve All Success',
                    'data' =>$Transaksi
                ],200);
            }
            return response([
                'message' => 'Empty',
                'data' => null
            ],400);
    }

    public function performaDriver()
    {
        $Transaksi = DB::table('transaksi')
            ->join('driver', 'transaksi.ID_DRIVER', '=', 'driver.ID_DRIVER')
            ->select('driver.FOTO_DRIVER','driver.ID_DRIVER','driver.NAMA_DRIVER',DB::raw('COUNT(transaksi.ID_DRIVER) as JUMLAH_TRANSAKSI'),DB::raw('AVG(transaksi.RATING_DRIVER) as RERATA_RATING'))
            ->groupBy('driver.ID_DRIVER','driver.NAMA_DRIVER','driver.FOTO_DRIVER')
            ->limit(5)
            ->orderBydesc(DB::raw('AVG(transaksi.RATING_DRIVER)'))
            ->get();

            if(count($Transaksi)>0){
                return response([
                    'message' => 'Retrieve All Success',
                    'data' =>$Transaksi
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
        $storeData['STATUS_TRANSAKSI'] = 'Valid';
        $idMobil = $storeData['ID_MOBIL'];
        $Mobil = Mobil::find($idMobil);

        $validate = Validator::make($storeData, [
            
        ]);
        
        if($validate->fails())
            return response(['message' => $validate->errors()],400);

        $Transaksi = Transaksi::create($storeData);
        $Mobil->STATUS_KETERSEDIAAN = 'Tidak Tersedia';
        $Mobil->save();
        return response([
            'message' => 'Add transaction Success',
            'data' =>$Transaksi
        ],200);  
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getTransaksiByDriver($ID_DRIVER)
    {
        $Transaksi = DB::table('transaksi')
            ->join('mobil', 'transaksi.ID_MOBIL', '=', 'mobil.ID_MOBIL')
            ->leftjoin('customer', 'transaksi.ID_CUSTOMER', '=', 'customer.ID_CUSTOMER')
            ->leftjoin('driver', 'transaksi.ID_DRIVER', '=' ,'driver.ID_DRIVER')
            ->select('transaksi.*','customer.NAMA_CUSTOMER','mobil.FOTO_MOBIL','mobil.NAMA_MOBIL')
            ->where('transaksi.ID_DRIVER',$ID_DRIVER )
            ->get();
        
        if(!is_null($Transaksi)){
            return response([
                'message' => 'Mengambil Data Transaksi Berhasil',
                'data' =>$Transaksi
            ],200);
        }
        return response([
            'message' => 'Transaksi Tidak Ditemukan',
            'data' => null
        ],404);
    }

    public function getTransaksiByCustomer($ID_CUSTOMER)
    {
        $Transaksi = DB::table('transaksi')
            ->join('mobil', 'transaksi.ID_MOBIL', '=', 'mobil.ID_MOBIL')
            ->leftjoin('customer', 'transaksi.ID_CUSTOMER', '=', 'customer.ID_CUSTOMER')
            ->leftjoin('driver', 'transaksi.ID_DRIVER', '=' ,'driver.ID_DRIVER')
            ->leftjoin('promo','transaksi.KODE_PROMO','promo.KODE_PROMO')
            ->select('transaksi.*','driver.NAMA_DRIVER','driver.FOTO_DRIVER','mobil.FOTO_MOBIL','mobil.NAMA_MOBIL','promo.PERSENTASE')
            ->where('transaksi.ID_CUSTOMER',$ID_CUSTOMER )
            ->get();
        
        if(!is_null($Transaksi)){
            return response([
                'message' => 'Mengambil Data Transaksi Berhasil',
                'data' =>$Transaksi
            ],200);
        }
        return response([
            'message' => 'Transaksi Tidak Ditemukan',
            'data' => null
        ],404);
    }

    public function getTransaksiByCustomerEmail($EMAIL_CUSTOMER)
    {
        $Transaksi = DB::table('transaksi')
            ->join('mobil', 'transaksi.ID_MOBIL', '=', 'mobil.ID_MOBIL')
            ->leftjoin('customer', 'transaksi.ID_CUSTOMER', '=', 'customer.ID_CUSTOMER')
            ->leftjoin('driver', 'transaksi.ID_DRIVER', '=' ,'driver.ID_DRIVER')
            ->leftjoin('promo','transaksi.KODE_PROMO','promo.KODE_PROMO')
            ->select('transaksi.*','driver.NAMA_DRIVER','driver.FOTO_DRIVER','mobil.FOTO_MOBIL','mobil.NAMA_MOBIL','promo.PERSENTASE','promo.KETERANGAN_PROMO','mobil.NAMA_MOBIL','mobil.FOTO_MOBIL','mobil.HARGA_SEWA_HARIAN_MOBIL')
            ->where('customer.EMAIL_CUSTOMER',$EMAIL_CUSTOMER)
            ->get();
        
        if(!is_null($Transaksi)){
            return response([
                'message' => 'Mengambil Data Transaksi Customer Berhasil',
                'data' =>$Transaksi
            ],200);
        }
        return response([
            'message' => 'Transaksi Tidak Ditemukan',
            'data' => null
        ],404);
    }

    public function show($ID_TRANSAKSI)
    {
        $Transaksi = Transaksi::find($ID_TRANSAKSI);
        
        if(!is_null($Transaksi)){
            return response([
                'message' => 'Mengambil Data Transaksi Berhasil',
                'data' =>$Transaksi
            ],200);
        }
        return response([
            'message' => 'Transaksi Tidak Ditemukan',
            'data' => null
        ],404);
    }

    public function showMobile($ID_TRANSAKSI)
    {
        $Transaksi = DB::table('transaksi')
            ->join('mobil', 'transaksi.ID_MOBIL', '=', 'mobil.ID_MOBIL')
            ->leftjoin('customer', 'transaksi.ID_CUSTOMER', '=', 'customer.ID_CUSTOMER')
            ->leftjoin('driver', 'transaksi.ID_DRIVER', '=' ,'driver.ID_DRIVER')
            ->leftjoin('promo','transaksi.KODE_PROMO','promo.KODE_PROMO')
            ->select('transaksi.*','promo.PERSENTASE','mobil.NAMA_MOBIL','mobil.FOTO_MOBIL','driver.FOTO_DRIVER ','driver.NAMA_DRIVER',DB::raw('AVG(transaksi.RATING_DRIVER) as RERATA_RATING'))
            ->where('transaksi.ID_TRANSAKSI',$ID_TRANSAKSI)
            ->get();
        
        if(!is_null($Transaksi)){
            return response([
                'message' => 'Mengambil Data Transaksi Berhasil',
                'data' =>$Transaksi
            ],200);
        }
        return response([
            'message' => 'Transaksi Tidak Ditemukan',
            'data' => null
        ],404);
    }

    public function driverByTransaksi($ID_DRIVER)
    {
        $Transaksi = DB::table('transaksi')
            ->rightjoin('driver', 'transaksi.ID_DRIVER', '=' ,'driver.ID_DRIVER')
            ->select('driver.NAMA_DRIVER','driver.ALAMAT_DRIVER','driver.EMAIL_DRIVER','driver.NO_TELP_DRIVER','driver.FOTO_DRIVER',DB::raw('AVG(transaksi.RATING_DRIVER) as RERATA_RATING'))
            ->where('driver.ID_DRIVER',$ID_DRIVER)
            ->get();
        
        if(!is_null($Transaksi)){
            return response([
                'message' => 'Mengambil Data Transaksi Berhasil',
                'data' =>$Transaksi
            ],200);
        }
        return response([
            'message' => 'Transaksi Tidak Ditemukan',
            'data' => null
        ],404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function rating($ID_TRANSAKSI,Request $request )
    {
        $Transaksi = Transaksi::find($ID_TRANSAKSI);
        if(is_null($Transaksi)){
            return response([
                'message' => 'Transaksi Not Found',
                'data' => null
            ],404);
        }

        $updateData = $request->all();
        $validate = Validator::make($updateData,[
            
        ]);

        if($validate->fails())
            return response(['message' => $validate->errors()],400);

        $Transaksi->RATING_AJR = $updateData['RATING_AJR'];
        $Transaksi->RATING_DRIVER = $updateData['RATING_DRIVER'];
   
        
        if($Transaksi->save()){
            return response([
                'message' => 'Beri Rating Berhasil',
                'data' => [$Transaksi]
            ],200);
        }

        return response([
            'message' => 'Update Transaksi failed',
            'data' => null,
        ],400);
    }


    public function update(Request $request, $ID_TRANSAKSI)
    {
        $Transaksi = Transaksi::find($ID_TRANSAKSI);
        if(is_null($Transaksi)){
            return response([
                'message' => 'Transaksi Not Found',
                'data' => null
            ],404);
        }

        $updateData = $request->all();
        $validate = Validator::make($updateData,[
            
        ]);

        if($validate->fails())
            return response(['message' => $validate->errors()],400);

        $Transaksi->ID_MOBIL = $updateData['ID_MOBIL'];
        $Transaksi->ID_DRIVER = $updateData['ID_DRIVER'];
        $Transaksi->ID_CUSTOMER = $updateData['ID_CUSTOMER'];
        $Transaksi->KODE_PROMO = $updateData['KODE_PROMO'];
        $Transaksi->TOTAL_BIAYA_SEWA = $updateData['TOTAL_BIAYA_SEWA'];
        $Transaksi->TANGGAL_MULAI_SEWA = $updateData['TANGGAL_MULAI_SEWA'];
        $Transaksi->TANGGAL_SELESAI_SEWA = $updateData['TANGGAL_SELESAI_SEWA'];
        
        if($Transaksi->save()){
            return response([
                'message' => 'Update Transaksi Success',
                'data' => $Transaksi
            ],200);
        }

        return response([
            'message' => 'Update Transaksi failed',
            'data' => null,
        ],400);
    }

    public function pembayaran(Request $request, $ID_TRANSAKSI)
    {
        $date = Carbon::now();
        $Transaksi = Transaksi::find($ID_TRANSAKSI);
        if(is_null($Transaksi)){
            return response([
                'message' => 'Promo Not Found',
                'data' => null
            ],404);
        }

        $updateData = $request->all();
        $validate = Validator::make($updateData,[
            
        ]);

        if($validate->fails())
            return response(['message' => $validate->errors()],400);

        $Transaksi->TOTAL_PEMBAYARAN = $updateData['TOTAL_PEMBAYARAN'];
        $Transaksi->RATING_AJR = $updateData['RATING_AJR'];
        $Transaksi->RATING_DRIVER = $updateData['RATING_DRIVER'];
        $Transaksi->METODE_PEMBAYARAN = $updateData['METODE_PEMBAYARAN'];
        $Transaksi->TANGGAL_PENGEMBALIAN = $date;
        $Transaksi->BIAYA_EKSTENSI_SEWA = $updateData['BIAYA_EKSTENSI_SEWA'];
        
        if($Transaksi->save()){
            return response([
                'message' => 'Pembayaran Success',
                'data' => $Transaksi
            ],200);
        }

        return response([
            'message' => 'Pembayaran failed',
            'data' => null,
        ],400);
    }

    public function verifikasi(Request $request, $ID_TRANSAKSI)
    {
        $Transaksi = Transaksi::find($ID_TRANSAKSI);
        if(is_null($Transaksi)){
            return response([
                'message' => 'Promo Not Found',
                'data' => null
            ],404);
        }

        $updateData = $request->all();
        $validate = Validator::make($updateData,[
            
        ]);

        if($validate->fails())
            return response(['message' => $validate->errors()],400);

        $Transaksi->STATUS_TRANSAKSI = $updateData['STATUS_TRANSAKSI'];
        if($Transaksi->save()){
            return response([
                'message' => 'Verification Success',
                'data' => $Transaksi
            ],200);
        }

        return response([
            'message' => 'Verification failed',
            'data' => null,
        ],400);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request, $id)
    // {
    //     //
    // }

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