<?php

namespace App\Policies;

use App\Resume;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ResumePolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function delete(User $user, Resume $resume)
    {
        return $user->id === $resume->user_id;
    }

    public function show(User $user, Resume $resume)
    {
        return $user->id === $resume->user_id;
    }
    public function update(User $user, Resume $resume)
    {
        return $user->id === $resume->user_id;
    }
}
