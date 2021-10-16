<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class CacheStoreController extends Controller
{
    public function storeCustomers()
    {
        // if (!Cache::has('customers_table_data')) {
        //     $customerStoreInCache = Cache::rememberForever('customers_table_data', function () {
        //         return DB::table('users')->get();
        //     });
        // }

        if (Cache::has('key'))
            Cache::forget('key');

        Cache::rememberForever('key', function () {
            return DB::table('users')->where('id', '>', 13000)->get();
        });

        $data = Cache::get('key');

        return response()->json([
            'data' => $data,
            'has_data_stored' => Cache::has('customers_table_data')
        ], 200);
    }
}
