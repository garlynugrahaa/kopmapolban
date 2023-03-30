<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ProductCategoryRequest;
use Illuminate\Support\Str;
use App\Models\ProductCategory;
use Illuminate\Database\QueryException;
use Yajra\DataTables\Facades\DataTables;
use RealRashid\SweetAlert\Facades\Alert;

class ProductCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Log::info(Auth::user()->fullname . " Sedang Mengakses product category");
        if (request()->ajax()) {
            $Data = ProductCategory::latest()->get();

            return DataTables::of($Data)->addIndexColumn()
                ->addColumn('action', function($item) {
                    return '
                        <div class="d-flex">
                            <a href="' . route('product-category.edit', $item->product_category_id) . '" class="ml-2 btn btn-warning shadow-none">
                                <span class="fas fa-edit"></span>
                            </a>
                            <form class="inline-block" action="' . route('product-category.destroy', $item->product_category_id) . '" method="POST">
                                <button class="ml-2 btn btn-danger shadow-none">
                                    <span class="fas fa-trash"></span>
                                </button>
                                ' . method_field('delete') . csrf_field() . '
                            </form>
                        </div>
                    ';
                })->rawColumns(['action'])->make(true);
        }

        return view('master.product-category.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Log::info(Auth::user()->fullname . " Sedang Membuat product category");
        return view('master.product-category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductCategoryRequest $Request)
    {
        try {
            $Data = $Request->all();
            $Data['product_category_slug'] = Str::slug($Request->product_category_name);

            ProductCategory::create($Data);
            Log::info(Auth::user()->fullname . " Sedang Menmebuat product category");
            Alert::success('Congrats', 'You\'ve Successfully Registered');
            return redirect()->route("product-category.index");
        } catch (\Exception $e) {
            Alert::error('Error', $e->getMessage());
            return redirect()->route("product-category.index");
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
        Log::info(Auth::user()->fullname . " Sedang Mengedit product category");
        $ProductCategory = ProductCategory::where('product_category_id', $id)->get();

        return view('master.product-category.edit', compact('ProductCategory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductCategoryRequest $Request, $id)
    {
        try {
            $Data = ProductCategory::where('product_category_id', $id);

            $Data->update([
                'product_category_name' => $Request->product_category_name, 
                'product_category_slug' => Str::slug($Request->product_category_name),
            ]);
            Log::info(Auth::user()->fullname . " Sedang Mengupdate product category");
            Alert::success('Congrats', 'You\'ve Successfully Updated');
            return redirect()->route('product-category.index');
        } catch (QueryException $e) {
            Alert::error('Error', $e->getMessage());
            return redirect()->route('product-category.index');
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
        Log::info(Auth::user()->fullname . " Sedang Mendelete product category");
        ProductCategory::where('product_category_id', $id)->delete();

        Alert::success('Congrats', 'You\'ve Successfully Deleted');
        return redirect()->route("product-category.index");
    }
}
