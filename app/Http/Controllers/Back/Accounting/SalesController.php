<?php

namespace App\Http\Controllers\Back\Accounting;

use App\Http\Controllers\Controller;
use App\Models\Accounting\Sale;
use Illuminate\Http\Request;

class SalesController extends Controller
{
    public function index()
    {
        return view("back.accounting.sales.index", [
            "sales" => Sale::query()->orderBy('created_at', 'desc')->get()
        ]);
    }
}
