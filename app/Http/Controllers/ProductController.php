<?php

namespace App\Http\Controllers;

use App\Models\BackupProduct;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Validator;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        return response()->json([
            'products' => $products
        ], 200);
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
        $validated = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',
            'count' => 'required',
            'price' => 'required',
            'user_id' => 'required'
        ]);



        if ($validated->fails()) {
            return response()->json([
                'error' => $validated->getMessageBag()
            ]);
        }

        $product = Product::create($request->all());

        return response()->json([
            'data' => $product
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product, $id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }

    //methods for Api

    public function showApi($id)
    {
        $product = Product::find($id);

        if ($product != null)
            return response()->json([
                'success' => true,
                'data' => $product
            ], 200);
        else
            return response()->json([
                'success' => false,
                'error_message' => 'Something went wrong,product not found'
            ], 404);
    }

    public function getLatestExecutedQuery()
    {
        DB::enableQueryLog(); // to enable query log
        $specific_order = Product::where('id', 55)->get();
        $users = User::all();

        $allProducts = Product::select('*')->get();

        $query = DB::getQueryLog(); //get query logs from cache

        $lastQuery = end($query);

        return response()->json([
            'data' => [
                'query-logs' => $query,
                'last-executed-query' => $lastQuery
            ]
        ], 200);
    }

    public function backupRecords()
    {
        DB::statement('INSERT INTO backup_products SELECT * FROM products');

        $backupProducts = BackupProduct::all();

        return response()->json([
            'backup-products' => $backupProducts
        ], 200);
    }

    public function findNewProducts()
    {
        $newProducts = DB::select('SELECT * FROM products
       EXCEPT 
       SELECT * FROM backup_products');

        return response()->json([
            'new-products' => $newProducts
        ], 200);
    }

    public function searchCaseSensitive(Request $request)
    {
        $product = Product::select('id', 'name', 'description')->where(Product::raw('BINARY name'), $request->name)->get()->toArray();

        if ($product == null) {
            return response()->json([
                'success' => true,
                'message' => 'there is no any product'
            ], 200);
        }

        return response()->json([
            'success' => true,
            'data' => $product
        ], 200);
    }
}
