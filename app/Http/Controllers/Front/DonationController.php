<?php

namespace App\Http\Controllers\Front;

use App\Helpers\LogActivity;
use App\Http\Controllers\Controller;
use App\Models\Accounting\Sale;
use Illuminate\Http\Request;
use Srmklive\PayPal\Facades\PayPal;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class DonationController extends Controller
{
    public function donationSuccess(Request $request)
    {
        LogActivity::addToLog("Donation de ".$request['amt']." effectuer avec succès");
        toastr()->success("Votre donation de ".$request["amt"]." à été effectuer avec succès");
        return redirect()->route("home");
    }

    public function donationCancelled(Request $request)
    {
        dd($request->all());
    }

    public function donationNotify(Request $request)
    {
    }
}
