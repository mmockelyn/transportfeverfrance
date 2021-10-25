<?php

namespace App\Jobs\Account;

use App\Models\Account\UserDeviceToken;
use Aws\Sns\Exception\SnsException;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;

class SendPushNotificationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $notificationTitle = "Test Notification";
        $notificationMessage = "Bonjour! Ceci est une notification de test";

        $data = [
            "type" => "manual notification"
        ];

        $userDeviceTokens = UserDeviceToken::all();

        foreach ($userDeviceTokens as $userDeviceToken) {
            $deviceToken = $userDeviceToken->device_token;
            $endPointArn = ["EndpointArn" => $deviceToken->arn];

            try {
                $sns = App::make('aws')->createClient('sns');
                $endpointAtt = $sns->getEndpointAttributes($endPointArn);

                if ($endpointAtt != 'failed' && $endpointAtt['Attributes']['Enabled'] != 'false') {
                    if ($deviceToken->platform == 'android') {
                        $fcmPayload = json_encode(
                            [
                                'notification' =>
                                [
                                    "title" => $notificationTitle,
                                    "body" => $notificationMessage,
                                    "sound" => 'default'
                                ],
                                'data' => $data
                            ]
                        );

                        $message = json_encode(["default" => $notificationMessage, "GCM" => $fcmPayload]);
                        $sns->publish([
                            "TargetArn" => $deviceToken->arn,
                            "Message" => $message,
                            "MessageStructure" => 'json'
                        ]);
                    }
                }
            } catch (SnsException $exception) {
                Log::error($exception->getMessage());
            }
        }
    }
}
