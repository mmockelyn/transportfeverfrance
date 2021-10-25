<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Models\Account\UserDeviceToken;
use App\Models\User;
use Aws\Sns\Exception\SnsException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class UserDeviceTokenController extends Controller
{
    public function getDeviceToken(Request $request)
    {
        $input = $request->only('user_id', 'platform', 'device_token');
        try {
            $deviceToken = UserDeviceToken::whereDeviceToken($input['device_token'])->first();
            if ($deviceToken == null) {
                $platformApplicationArn = "";
                if (isset($input['platform']) && $input['platform'] == 'android') {
                    $platformApplicationArn = env('ANDROID_APPLICATION_ARN');
                }

                $client = App::make('aws')->createClient('sns');

                $result = $client->createPlatformEndpoint([
                    "PlatformApplicationArn" => $platformApplicationArn,
                    "Token" => $input['device_token']
                ]);

                $endPointArn = isset($result['EndpointArn']) ? $result['EndpointArn'] : '';
                $deviceToken = new UserDeviceToken();
                $deviceToken->platform = $input['platform'];
                $deviceToken->device_token = $input['device_token'];
                $deviceToken->arn = $endPointArn;
            }

            $deviceToken->user_id = $input['user_id'];
            $deviceToken->save();
        } catch (SnsException $exception) {
            return response()->json(['error' => "Unexpected Error"], 500);
        }

        return response()->json(["status" => "Device Token Processed"], 200);
    }
}
