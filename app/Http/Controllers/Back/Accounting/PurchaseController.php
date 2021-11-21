<?php

namespace App\Http\Controllers\Back\Accounting;

use App\Http\Controllers\Controller;
use App\Models\Accounting\Purchase;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    public function index()
    {
        return view("back.accounting.purchases.index", [
            "purchases" => Purchase::query()->orderBy('created_at', 'desc')->get()
        ]);
    }
}
