<?php


namespace App\Repository\Account;


use App\Models\User;
use App\Models\UserSocial;
use App\Models\UserTutorial;

class UserRepository
{
    /**
     * @var User
     */
    private $user;
    /**
     * @var UserSocial
     */
    private $social;
    /**
     * @var UserTutorial
     */
    private $tutorial;

    /**
     * UserRepository constructor.
     * @param User $user
     * @param UserSocial $social
     * @param UserTutorial $tutorial
     */
    public function __construct(User $user, UserSocial $social, UserTutorial $tutorial)
    {
        $this->user = $user;
        $this->social = $social;
        $this->tutorial = $tutorial;
    }

    public function getInfoUser($user_id)
    {
        return $this->user->newQuery()->findOrFail($user_id);
    }

    public function storeInvolveTutoWrapper($user_id)
    {
        $user = $this->getInfoUser($user_id);

        if($user->description !== null)
            $this->tutorial->newQuery()->create(['title' => "Validation de votre compte", 'user_id' => $user_id, 'checked' => true]);
        else
            $this->tutorial->newQuery()->create(['title' => "Validation de votre compte", 'user_id' => $user_id, 'checked' => false]);

        if($user->avatar !== null)
            $this->tutorial->newQuery()->create(['title' => "Définition de votre avatar", 'user_id' => $user_id, 'checked' => true]);
        else
            $this->tutorial->newQuery()->create(['title' => "Définition de votre avatar", 'user_id' => $user_id, 'checked' => false]);

        if($user->social->facebook_id !== null)
            $this->tutorial->newQuery()->create(['title' => "Connexion de votre compte facebook", 'user_id' => $user_id, 'checked' => true]);
        else
            $this->tutorial->newQuery()->create(['title' => "Connexion de votre compte facebook", 'user_id' => $user_id, 'checked' => false]);

        if($user->social->google_id !== null)
            $this->tutorial->newQuery()->create(['title' => "Connexion de votre compte google", 'user_id' => $user_id, 'checked' => true]);
        else
            $this->tutorial->newQuery()->create(['title' => "Connexion de votre compte google", 'user_id' => $user_id, 'checked' => false]);

        if($user->social->twitter_id !== null)
            $this->tutorial->newQuery()->create(['title' => "Connexion de votre compte twitter", 'user_id' => $user_id, 'checked' => true]);
        else
            $this->tutorial->newQuery()->create(['title' => "Connexion de votre compte twitter", 'user_id' => $user_id, 'checked' => false]);

        if($user->social->steam_id !== null)
            $this->tutorial->newQuery()->create(['title' => "Connexion de votre compte steam", 'user_id' => $user_id, 'checked' => true]);
        else
            $this->tutorial->newQuery()->create(['title' => "Connexion de votre compte steam", 'user_id' => $user_id, 'checked' => false]);

        if($user->social->discord_user_id !== null)
            $this->tutorial->newQuery()->create(['title' => "Connexion de votre compte discord", 'user_id' => $user_id, 'checked' => true]);
        else
            $this->tutorial->newQuery()->create(['title' => "Connexion de votre compte discord", 'user_id' => $user_id, 'checked' => false]);


    }

    public function getValueCompleteTuto($user_id)
    {
        $all = $this->tutorial->newQuery()->where('user_id', $user_id);
        $total = $all->count();
        $complete = $all->where('checked', 1)->count();

        return 100*$complete/$total;
    }


}
