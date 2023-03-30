<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use Illuminate\Support\Str;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Transaksi;
use App\Models\DetailTransaksi;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use RealRashid\SweetAlert\Facades\Alert;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (empty($_GET['product_code'])) {
            $product_code = "sasd";
        }
        else{
            $product_code = $_GET['product_code'];
        }
       
       
        $Products = Product::where('id', $product_code)->get();
        // $Products = Product::all();
        return view('master.transaksi.index', compact('Products'));
    }

    public function addItem(Request $request) {
        echo "haiiis";
        die();
        $rules = array (
                'name' => 'required'
        );
        $validator = Validator::make ( Input::all (), $rules );
        if ($validator->fails ())
            return Response::json ( array (
                        
                    'errors' => $validator->getMessageBag ()->toArray ()
            ) );
            else {
                $data = new Data ();
                $data->name = $request->name;
                $data->save ();
                return response ()->json ( $data );
            }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        echo "test";
        echo $_GET['name'];
        die();
        $rules = array (
                'name' => 'required'
        );
        $validator = Validator::make ( Input::all (), $rules );
        if ($validator->fails ())
            return Response::json ( array (
                        
                    'errors' => $validator->getMessageBag ()->toArray ()
            ) );
            else {
                $data = new Data ();
                $data->name = $request->name;
                $data->save ();
                return response ()->json ( $data );
            }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   
        $Transaction = Transaksi::where('id', $id)->get();
        $DetailTransaction = DetailTransaksi::select('detail_transaksi.*', 'transaksi.total_pembayaran', 'products.product_name')
                                            ->join('transaksi', 'transaksi.id', '=', 'detail_transaksi.id_transaksi')
                                            ->join('products', 'products.product_id', '=', 'detail_transaksi.id_product')
                                            ->where('transaksi.id', '=', $id)->get();

        $PDF = PDF::loadview('master.transaksi.struct', compact('Transaction', 'DetailTransaction'));
        
        return $PDF->download('Struk.pdf');
        return redirect()->route('transaksi.index');
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

    public function struct($id)
    {
        echo "hai";
        die();
        $Transaction = Transaksi::where('id', $id)->get();
        $DetailTransaction = DetailTransaksi::select('detail_transaksi.*', 'transaksi.total_pembayaran', 'products.product_name')
                                            ->join('transaksi', 'transaksi.id', '=', 'detail_transaksi.transaksi_id')
                                            ->join('products', 'products.product_id', '=', 'detail_transaksi.product_id')
                                            ->where('id', '=', $id)->get();

        $PDF = PDF::loadview('master.transaksi.struct', compact('Transaction', 'DetailTransaksi'));
        
        return $PDF->download('Struk.pdf');
    }
}
