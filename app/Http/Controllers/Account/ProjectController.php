<?php

namespace App\Http\Controllers\Account;

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
    }

    public function index()
    {
        $user = User::find(auth()->user()->id);
        if ($user->social->project_active_user == 0) {
            return view('account.project.index');
        } else {
            return view('account.project.index');
        }
    }

    public function register(Request $request)
    {
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

            toastr()->success("Votre compte TPF France est maintenant lié au gestionnaire de projet.");

            return redirect()->back();
        }catch (\Exception $exception) {

            toastr()->error("Erreur lors de la liaison de votre compte au gestionnaire de projet.", "Erreur Serveur");

            return redirect()->back();
        }
    }
}
