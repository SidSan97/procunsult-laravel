<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ClientePolicy
{
    /**
     * Create a new policy instance.
     */
    use HandlesAuthorization;

    public function __construct()
    {
        //
    }

    public function cliente(User $user)
    {
        return $user->nivel === 'Cliente';
    }
}
