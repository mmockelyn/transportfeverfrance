<?php

namespace App\Http\Controllers\Back\Accounting;

use App\Http\Controllers\Controller;
use App\Models\Accounting\Bank;
use Illuminate\Http\Request;

class FinanceController extends Controller
{
    public function index()
    {
        return view("back.accounting.banks.index", [
            "banks" => Bank::query()->orderBy('created_at', 'desc')->get()
        ]);
    }
}
