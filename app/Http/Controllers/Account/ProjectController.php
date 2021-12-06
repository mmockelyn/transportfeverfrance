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
            $user_p = DB::connection('project')->table('users')->where('email', auth()->user()->email)->first();
            $projects = DB::connection('project')->table('project_user')->where('user_id', $user_p->id)->get();



            $array = [];
            foreach ($projects as $project) {
                $projects_p = DB::connection('project')->table('projects')->find($project->project_id);
                $array[] = [
                    "projects" => $projects_p
                ];
            }

            return view('account.project.index', [
                "projects" => $array
            ]);
        }
    }

    public function register(Request $request)
    {
        $this->getAuthenticated();
        $user = User::where('email', $request->get('email'))->first();
        try {
            $count = DB::connection('project')->table('users')->where('email', $request->get('email'))->count();

            if($count == 0) {
                DB::connection('project')->table('users')->insert([
                    "name" => $user->name,
                    "email" => $user->email,
                    "password" => $user->password
                ]);
            }

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
