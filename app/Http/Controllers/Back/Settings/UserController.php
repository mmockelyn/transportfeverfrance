<?php

namespace App\Http\Controllers\Back\Settings;

use App\Exports\Back\Settings\UsersExport;
use App\Helpers\Format;
use App\Helpers\LogActivity;
use App\Http\Controllers\Controller;
use App\Models\Account\UserDeviceToken;
use App\Models\User;
use App\Models\UserSocial;
use App\Notifications\Back\Setting\User\NewUserWithoutPassword;
use App\Repository\Account\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class UserController extends Controller
{
    /**
     * @var UserRepository
     */
    private UserRepository $userRepository;

    /**
     * UserController constructor.
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function createNewUser(Request $request)
    {
        //dd($request->all());

        $password = Str::random(8);
        $password_complex = Format::passwordComplexity($password);

        try {
            $user = User::create([
                "name" => $request->get('name'),
                "email" => $request->get('email'),
                "group" => $request->get('user_role'),
                "password" => Hash::make($password),
                "email_verified_at" => now(),
                "valid" => 1,
                "password_complexity" => $password_complex
            ]);

            UserSocial::create([
                "user_id" => $user->id
            ]);

            UserDeviceToken::create([
                "user_id" => $user->id
            ]);

            $this->userRepository->storeInvolveTutoWrapper($user->id);

            $user->notify(new NewUserWithoutPassword($user, $password));

            return response()->json($user);
        } catch (\Exception $exception) {
            return response()->json(["error" => $exception->getMessage()], 500);
        }
    }

    public function exportUsers(Request $request)
    {
        switch ($request->get('format')) {
            case 'excel':
                return $this->exportExcel($request);
                break;

            case 'pdf':
                return $this->exportPdf($request);
                break;

            case 'csv':
                return $this->exportCsv($request);
                break;
        }
    }

    public function index()
    {
        return view('back.settings.users.index', [
            "users" => User::all()
        ]);
    }

    public function show($user_id)
    {
        return view('back.settings.users.show', [
            "user" => User::query()->find($user_id)
        ]);
    }

    public function updateProfil(Request $request, $user_id)
    {
        //dd($request->all());
        $user = User::find($user_id);
        try {
            $user->update([
                "name" => $request->get('name'),
                "email" => $request->get('email'),
                "description" => $request->get('description')
            ]);

            //Mise à jour de l'avatar
            if($request->file('avatar')) {
                try {
                    $request->file('avatar')->storeAs('files/shares/avatar/', $request->file('avatar')->getClientOriginalName(), 'public');
                    try {
                        $user->update([
                            "avatar" => $request->file('avatar')->getClientOriginalName()
                        ]);
                        LogActivity::addToLog("Mise à jour du profil de l'utilisateur <strong>$user->name</strong> effectuer");
                        toastr()->success("Le profil de l'utilisateur $user->name à été mis à jour", "Mise à jour des informations");
                        return redirect()->back();
                    }catch (\Exception $exception) {
                        LogActivity::addToLog($exception->getMessage());
                        toastr()->error("Erreur lors de la mise à jour du profil de l'utilisateur", "Erreur Serveur");
                        return redirect()->back();
                    }
                }catch (FileException $exception) {
                    LogActivity::addToLog($exception->getMessage());
                    toastr()->error("Erreur lors de la mise à jour de l'avatar de l'utilisateur", "Erreur File Serveur");
                    return redirect()->back();
                }
            } else {
                LogActivity::addToLog("Mise à jour du profil de l'utilisateur <strong>$user->name</strong> effectuer");
                toastr()->success("Le profil de l'utilisateur $user->name à été mis à jour", "Mise à jour des informations");
                return redirect()->back();
            }
        }catch (\Exception $exception) {
            LogActivity::addToLog($exception->getMessage());
            toastr()->error("Erreur lors de la mise à jour du profil de l'utilisateur", "Erreur Serveur");
            return redirect()->back();
        }
    }

    private function exportExcel($request)
    {
        return Excel::download(new UsersExport($request->get('group')), 'users_' . now()->format('d_m_Y_H_i') . ".xlsx", \Maatwebsite\Excel\Excel::XLSX);
    }

    private function exportPdf($request)
    {
        return Excel::download(new UsersExport($request->get('group')), 'users_' . now()->format('d_m_Y_H_i') . ".pdf", \Maatwebsite\Excel\Excel::DOMPDF);
    }

    private function exportCsv($request)
    {
        return Excel::download(new UsersExport($request->get('group')), 'users_' . now()->format('d_m_Y_H_i') . ".csv", \Maatwebsite\Excel\Excel::CSV, [
            'Content-Type' => 'text/csv',
        ]);
    }
}
