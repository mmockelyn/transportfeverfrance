<?php


namespace App\Packages\PaypalApi;


use Illuminate\Support\Facades\Http;
use PayPal\Api\Payment;
use PayPal\Api\Transaction;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;

class PaypalApi
{
    private $apiContext;

    public function __construct()
    {
        if(config('paypal.mode') == 'live') {
            $this->apiContext = new ApiContext(
                new OAuthTokenCredential(
                    config('paypal.live.client_id'),
                    config('paypal.live.client_secret')
                )
            );
        } else {
            $this->apiContext = new ApiContext(
                new OAuthTokenCredential(
                    config('paypal.sandbox.client_id'),
                    config('paypal.sandbox.client_secret')
                )
            );
            $this->apiContext->setConfig([
                'log.LogEnabled' => true,
                'log.FileName' => 'PayPal.log',
                'log.LogLevel' => 'DEBUG'
            ]);
        }
    }

    public function listTransactions()
    {
        try {
            $params = ['count' => 10];

            $transactions = Payment::all($params);

            dd($transactions);
        }catch (\Exception $exception) {
            dd($exception->getMessage());
        }
    }
}
