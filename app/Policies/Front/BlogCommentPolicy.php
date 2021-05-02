<?php

namespace App\Policies\Front;

use App\Models\Blog\BlogComment;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BlogCommentPolicy
{
    use HandlesAuthorization;

    protected function manage(User $user, BlogComment $blogComment)
    {
        return $user->isAdmin() ?: $user->id === $blogComment->user_id;
    }

    /**
     * Determine whether the user can view any models.
     *
     * @param User $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param User $user
     * @param BlogComment $blogComment
     * @return mixed
     */
    public function view(User $user, BlogComment $blogComment)
    {
        return true;
    }


    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param BlogComment $blogComment
     * @return mixed
     */
    public function update(User $user, BlogComment $blogComment)
    {
        return $this->manage($user, $blogComment);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param  \App\Models\BlogComment  $blogComment
     * @return mixed
     */
    public function delete(User $user, BlogComment $blogComment)
    {
        return $this->manage($user, $blogComment);
    }
}
