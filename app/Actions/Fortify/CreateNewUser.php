<?php

namespace App\Actions\Fortify;

use App\Events\newUser;
use App\Helpers\Format;
use App\Models\Account\UserDeviceToken;
use App\Models\User;
use App\Models\UserSocial;
use App\Notifications\Back\Setting\User\NewUserWithoutPassword;
use App\Repository\Account\UserRepository;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * CreateNewUser constructor.
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        if (isset($input['password'])) {
            Validator::make($input, [
                'name' => ['required', 'string', 'max:255'],
                'email' => [
                    'required',
                    'string',
                    'email',
                    'max:255',
                    Rule::unique(User::class),
                ],
                'password' => $this->passwordRules(),
            ])->validate();
        } else {
            Validator::make($input, [
                'name' => ['required', 'string', 'max:255'],
                'email' => [
                    'required',
                    'string',
                    'email',
                    'max:255',
                    Rule::unique(User::class),
                ],
            ])->validate();
        }

        $password = Str::random(8);

        $complexity = Format::passwordComplexity($input['password']);

        if(isset($input['password'])) {
            $user =  User::create([
                'name' => $input['name'],
                'email' => $input['email'],
                'password' => Hash::make($input['password']),
                'password_complexity' => $complexity
            ]);
        } else {
            $user =  User::create([
                'name' => $input['name'],
                'email' => $input['email'],
                'password' => Hash::make($password),
                'password_complexity' => $complexity
            ]);
        }

        UserSocial::create([
            "user_id" => $user->id
        ]);

        UserDeviceToken::create([
            "user_id" => $user->id
        ]);

        if (isset($input['password'])) {
            event(new newUser($user));
        } else {
            $user->notify(new NewUserWithoutPassword($user, $password));
        }

        $this->userRepository->storeInvolveTutoWrapper($user->id);

        return $user;
    }
}
