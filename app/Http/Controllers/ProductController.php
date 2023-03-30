<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Str;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use RealRashid\SweetAlert\Facades\Alert;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Log::info(Auth::user()->fullname . " Sedang Mengakses data product");
        if (request()->ajax()) {
            $Data = Product::join('product_categories', 'product_categories.product_category_id', '=', 'products.product_category_id')->get();

            return DataTables::of($Data)->addIndexColumn()
                                        ->addColumn('action', function($item) {
                                            return '
                                                <div class="d-flex">
                                                    <a href="' . route('product.edit', $item->product_id) . '" class="ml-2 btn btn-warning shadow-none">
                                                        <span class="fas fa-edit"></span>
                                                    </a>
                                                    <form class="inline-block" action="' . route('product.destroy', $item->product_id) . '" method="POST">
                                                        <button class="ml-2 btn btn-danger shadow-none">
                                                            <span class="fas fa-trash"></span>
                                                        </button>
                                                        ' . method_field('delete') . csrf_field() . '
                                                    </form>
                                                </div>
                                            ';
                                        })->rawColumns(['action'])->make();
        }

        return view('master.product.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Log::info(Auth::user()->fullname . " Sedang mebuat data product");
        $ProductCategory = ProductCategory::all();

        return view('master.product.create', compact('ProductCategory'));
    }

    public function check_product($id){
        $Product = Product::where('id', $id)->count();
        

        if ($Product == 0 ) {
            return redirect('/master/product/create')->with(['success' => $id]);;
        }
        else{
            return redirect('/product/add_stock/'.$id);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $Request)
    {
        try {
            $Data  = [
                'product_category_id' => $Request->product_category_id,
                'id' => $Request->product_code,
                'product_name' => $Request->product_name,
                'product_stock' => $Request->product_stock,
                'product_price' => $Request->product_price,
                'product_desc' => $Request->product_desc,
                'product_slug' => Str::slug($Request->product_name),
                'product_exp' => $Request->product_exp,
            ];

            Product::create($Data);
            Log::info(Auth::user()->fullname . " Sedang Membuat data product");
            Alert::success('Congrats', 'You\'ve Successfully Registered');
            return redirect()->route('product.index');
        } catch (QueryException $e) {
            Alert::error('Error', $e->getMessage());
            return redirect()->route('product.index');
        }
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
        
        Log::info(Auth::user()->fullname . " Sedang mengedit product");
        $Product = Product::where('product_id', $id)->get();
        $ProductCategory = ProductCategory::all();
        return view('master.product.edit', compact('Product','ProductCategory'));
    }

    public function add_stock($id)
    {
        Log::info(Auth::user()->fullname . " Sedang mengedit product");
        $Product = Product::where('id', $id)->get();
        $ProductCategory = ProductCategory::all();
        return view('master.product.add_stock', compact('Product','ProductCategory'));
    }

    public function update_stock(Request $Request)
    {
        try {
            $Data = Product::where('id', $Request->product_code);

            $Data->update([
                'id' => $Request->product_code,
                'product_stock' => $Request->product_stock + $Request->add_stock,
            ]);
            Log::info(Auth::user()->fullname . " Sedang Mengupdate product");
            Alert::success('Congrats', 'You\'ve Successfully Add Stock');
            return redirect()->route('product.index');
        } catch (QueryException $e) {
            Alert::error('Error', $e->getMessage());
            return redirect()->route('product.index');
        }
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $Request, $id)
    {
        try {
            $Data = Product::where('product_id', $id);

            $Data->update([
                'product_category_id' => $Request->product_category_id,
                'id' => $Request->product_code,
                'product_name' => $Request->product_name,
                'product_stock' => $Request->product_stock,
                'product_price' => $Request->product_price,
                'product_desc' => $Request->product_desc,
                'product_slug' => Str::slug($Request->product_name),
                'product_exp' => $Request->product_exp,
            ]);
            Log::info(Auth::user()->fullname . " Sedang Mengupdate product");
            Alert::success('Congrats', 'You\'ve Successfully Updated');
            return redirect()->route('product.index');
        } catch (QueryException $e) {
            Alert::error('Error', $e->getMessage());
            return redirect()->route('product.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Log::info(Auth::user()->fullname . " Sedang mengdelete product");
        Product::where('product_id', $id)->delete();

        Alert::success('Congrats', 'You\'ve Successfully Deleted');
        return redirect()->route('product.index');
    }
}
