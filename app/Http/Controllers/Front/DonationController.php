<?php

namespace App\Http\Controllers\Front;

use App\Helpers\LogActivity;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
        dd($request->all());
    }
}
