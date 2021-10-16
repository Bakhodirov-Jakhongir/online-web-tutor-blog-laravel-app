<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\ProductExport;
use App\Models\Product;
use Maatwebsite\Excel\Facades\Excel;

class DataExportContoller extends Controller
{
    public function export()
    {
        $countries = Product::select(['id', 'name', 'description', 'price', 'count', 'user_id'])->get();

        return Excel::download(new ProductExport($countries), 'products.xlsx');
    }
}
