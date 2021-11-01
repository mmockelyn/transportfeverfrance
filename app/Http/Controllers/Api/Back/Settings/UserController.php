<?php

namespace App\Http\Controllers\Api\Back\Settings;

use App\Helpers\LogActivity;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Notifications\Back\Setting\User\UserDeleted;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function delete($user_id)
    {
        $user = User::query()->find($user_id);

        try {
            $user->delete();

            $user->notify(new UserDeleted($user));

            LogActivity::addToLog("Suppression de l'utilisateur <strong>$user->name</strong> effectuer");
            return response()->json();
        }catch (\Exception $exception) {
            LogActivity::addToLog($exception->getMessage());
            return response()->json(["error", $exception->getMessage()], 500);
        }
    }
}
