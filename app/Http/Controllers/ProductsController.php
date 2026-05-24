<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $products = Product::query();

            $sortCol = null;
            $sortDir = null;

            if($request->has('order') && $request->get('order')) {
                $sortCol = $request->get('order')[0]['name'];
                $sortDir = $request->get('order')[0]['dir'];

                if($sortCol == 'DT_RowIndex') {
                    $sortCol = null;
                    $sortDir = null;
                }
            }

            if($sortCol) {
                $products = $products->orderBy($sortCol, $sortDir ?? 'asc');
            }

            $filterCount = $products->clone()->count();
            $totalCount = Product::count();

            $products = $products->skip($request->start ?? 0)
                ->take($request->length ?? 10);

            $products = $products->with('category')->get();

            return DataTables::of($products)
                ->with([
                    "recordsTotal" => $totalCount,
                    "recordsFiltered" => $filterCount,
                ])
                ->skipPaging()
                ->addIndexColumn()
                ->addColumn('name',function ($row){
                    return view('products.columns._name',['product'=>$row])->render();
                })
                ->addColumn('select', function ($row) {
                    return view('products.columns._select', ['product' => $row])->render();
                })
                ->editColumn('description', function ($row) {
                    return view('products.columns._description', ['product' => $row])->render();
                })
                ->addColumn('action', function ($row) {
                    return view('products.columns._actions', ['product' => $row])->render();
                })
                ->rawColumns(['action','name','select','description'])
                ->make(true);
        }
        $categories = Category::all();
        return view('products.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storeOrUpdate(Request $request)
    {
        $request->validate([
            'name' => 'required|min:2'
        ]);

        if ($request->id) {
            Product::find($request->id)->update($request->all());
        } else {
            Product::create($request->all());
        }

        return response()->json(['message' => 'Product Created Successfully!']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Product $product)
    {
        return response()->json($product);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request,Product $product)
    {
        $product->delete();
        return response()->json(['message' => 'Product Deleted Successfully!']);
    }
}
