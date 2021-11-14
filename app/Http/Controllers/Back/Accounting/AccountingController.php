<?php

namespace App\Http\Controllers\Back\Accounting;

use App\Http\Controllers\Controller;
use App\Models\Accounting\Bank;
use App\Models\Accounting\Purchase;
use App\Models\Accounting\Sale;
use App\Packages\PaypalApi\PaypalApi;
use Illuminate\Http\Request;


class AccountingController extends Controller
{
    public function dashboard()
    {
        return view("back.accounting.dashboard", [
            "sales" => Sale::query()->limit(5)->orderBy('created_at', 'asc')->get(),
            "purchases" => Purchase::query()->limit(5)->orderBy('created_at', 'asc')->get(),
            "banks" => Bank::query()->limit(5)->orderBy('created_at', 'asc')->get(),
        ]);
    }
}
