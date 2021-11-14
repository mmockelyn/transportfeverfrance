<?php

namespace App\Http\Controllers\Api\Back\Accounting;

use App\Helpers\Format;
use App\Http\Controllers\Controller;
use App\Models\Accounting\Bank;
use App\Models\Accounting\Purchase;
use App\Models\Accounting\Sale;

class AccountingController extends Controller
{
    public function getSalesStat()
    {
        $janv = Sale::query()->whereBetween('created_at', [now()->year.'-01-01', now()->year.'-01-31'])->sum('amount');
        $fev = Sale::query()->whereBetween('created_at', [now()->year.'-02-01', now()->year.'-02-28'])->sum('amount');
        $mars = Sale::query()->whereBetween('created_at', [now()->year.'-03-01', now()->year.'-03-31'])->sum('amount');
        $avr = Sale::query()->whereBetween('created_at', [now()->year.'-04-01', now()->year.'-04-30'])->sum('amount');
        $mai = Sale::query()->whereBetween('created_at', [now()->year.'-05-01', now()->year.'-05-31'])->sum('amount');
        $juin = Sale::query()->whereBetween('created_at', [now()->year.'-06-01', now()->year.'-06-30'])->sum('amount');
        $jul = Sale::query()->whereBetween('created_at', [now()->year.'-07-01', now()->year.'-07-31'])->sum('amount');
        $aout = Sale::query()->whereBetween('created_at', [now()->year.'-08-01', now()->year.'-08-31'])->sum('amount');
        $sept = Sale::query()->whereBetween('created_at', [now()->year.'-09-01', now()->year.'-09-30'])->sum('amount');
        $oct = Sale::query()->whereBetween('created_at', [now()->year.'-10-01', now()->year.'-10-31'])->sum('amount');
        $nov = Sale::query()->whereBetween('created_at', [now()->year.'-11-01', now()->year.'-11-30'])->sum('amount');
        $dec = Sale::query()->whereBetween('created_at', [now()->year.'-12-01', now()->year.'-12-31'])->sum('amount');

        $total = $janv + $fev + $mars + $avr + $mai + $juin + $jul + $aout + $sept + $oct + $nov + $dec;

        return response()->json(["data" => [$janv, $fev, $mars, $avr, $mai, $juin, $jul, $aout, $sept, $oct, $nov, $dec], "sum" => Format::number_format($total)]);
    }

    public function getPurchaseStat()
    {
        $janv = Purchase::query()->whereBetween('created_at', [now()->year.'-01-01', now()->year.'-01-31'])->sum('amount');
        $fev = Purchase::query()->whereBetween('created_at', [now()->year.'-02-01', now()->year.'-02-28'])->sum('amount');
        $mars = Purchase::query()->whereBetween('created_at', [now()->year.'-03-01', now()->year.'-03-31'])->sum('amount');
        $avr = Purchase::query()->whereBetween('created_at', [now()->year.'-04-01', now()->year.'-04-30'])->sum('amount');
        $mai = Purchase::query()->whereBetween('created_at', [now()->year.'-05-01', now()->year.'-05-31'])->sum('amount');
        $juin = Purchase::query()->whereBetween('created_at', [now()->year.'-06-01', now()->year.'-06-30'])->sum('amount');
        $jul = Purchase::query()->whereBetween('created_at', [now()->year.'-07-01', now()->year.'-07-31'])->sum('amount');
        $aout = Purchase::query()->whereBetween('created_at', [now()->year.'-08-01', now()->year.'-08-31'])->sum('amount');
        $sept = Purchase::query()->whereBetween('created_at', [now()->year.'-09-01', now()->year.'-09-30'])->sum('amount');
        $oct = Purchase::query()->whereBetween('created_at', [now()->year.'-10-01', now()->year.'-10-31'])->sum('amount');
        $nov = Purchase::query()->whereBetween('created_at', [now()->year.'-11-01', now()->year.'-11-30'])->sum('amount');
        $dec = Purchase::query()->whereBetween('created_at', [now()->year.'-12-01', now()->year.'-12-31'])->sum('amount');

        $total = $janv + $fev + $mars + $avr + $mai + $juin + $jul + $aout + $sept + $oct + $nov + $dec;

        return response()->json(["data" => [$janv, $fev, $mars, $avr, $mai, $juin, $jul, $aout, $sept, $oct, $nov, $dec], "sum" => Format::number_format($total)]);
    }

    public function getBalance()
    {
        $janv = Bank::query()->whereBetween('created_at', [now()->year.'-01-01', now()->year.'-01-31'])->sum('amount');
        $fev = Bank::query()->whereBetween('created_at', [now()->year.'-02-01', now()->year.'-02-28'])->sum('amount');
        $mars = Bank::query()->whereBetween('created_at', [now()->year.'-03-01', now()->year.'-03-31'])->sum('amount');
        $avr = Bank::query()->whereBetween('created_at', [now()->year.'-04-01', now()->year.'-04-30'])->sum('amount');
        $mai = Bank::query()->whereBetween('created_at', [now()->year.'-05-01', now()->year.'-05-31'])->sum('amount');
        $juin = Bank::query()->whereBetween('created_at', [now()->year.'-06-01', now()->year.'-06-30'])->sum('amount');
        $jul = Bank::query()->whereBetween('created_at', [now()->year.'-07-01', now()->year.'-07-31'])->sum('amount');
        $aout = Bank::query()->whereBetween('created_at', [now()->year.'-08-01', now()->year.'-08-31'])->sum('amount');
        $sept = Bank::query()->whereBetween('created_at', [now()->year.'-09-01', now()->year.'-09-30'])->sum('amount');
        $oct = Bank::query()->whereBetween('created_at', [now()->year.'-10-01', now()->year.'-10-31'])->sum('amount');
        $nov = Bank::query()->whereBetween('created_at', [now()->year.'-11-01', now()->year.'-11-30'])->sum('amount');
        $dec = Bank::query()->whereBetween('created_at', [now()->year.'-12-01', now()->year.'-12-31'])->sum('amount');

        $total = $janv + $fev + $mars + $avr + $mai + $juin + $jul + $aout + $sept + $oct + $nov + $dec;

        return response()->json([
            "data" => [$janv, $fev, $mars, $avr, $mai, $juin, $jul, $aout, $sept, $oct, $nov, $dec],
            "sum" => Format::number_format($total),
            "class" => $total < 0 ? "danger": ($total > 0 ? "success" : "info")
        ]);
    }
}
