<?php

namespace App\Http\Controllers\Account;

use App\Helpers\LogActivity;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;

class ProjectController extends Controller
{
    public function __construct()
    {
        if(auth()->guest()) {
            return redirect()->route('login');
        }
    }

    public function index()
    {
        $this->getAuthenticated();
        $user = User::find(auth()->user()->id);
        if ($user->social->project_active_user == 0) {
            return view('account.project.index');
        } else {
            return view('account.project.index');
        }
    }

    public function register(Request $request)
    {
        $this->getAuthenticated();
        $user = User::where('email', $request->get('email'))->first();
        try {
            DB::connection('project')->table('users')->insert([
                "name" => $user->name,
                "email" => $user->email,
                "password" => $user->password
            ]);

            $user->social()->update([
                "project_active_user" => 1
            ]);

            LogActivity::addToLog("Liaison au gestionnaire de projet effectuer");
            toastr()->success("Votre compte TPF France est maintenant lié au gestionnaire de projet.");

            return redirect()->back();
        }catch (\Exception $exception) {

            LogActivity::addToLog($exception->getMessage());
            toastr()->error("Erreur lors de la liaison de votre compte au gestionnaire de projet.", "Erreur Serveur");

            return redirect()->back();
        }
    }
}
