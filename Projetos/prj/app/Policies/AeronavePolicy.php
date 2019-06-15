<?php

namespace App\Policies;

use App\User;
use App\Aeronave;
use Illuminate\Auth\Access\HandlesAuthorization;

class AeronavePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the aeronave.
     *
     * @param  \App\User  $user
     * @param  \App\Aeronave  $aeronave
     * @return mixed
     */
    public function view(User $userLogado, Aeronave $aeronave)
    {
        return $userLogado->direcao;
    }

    /**
     * Determine whether the user can create aeronaves.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $userLogado)
    {
        return $userLogado->direcao;
    }

    /**
     * Determine whether the user can update the aeronave.
     *
     * @param  \App\User  $user
     * @param  \App\Aeronave  $aeronave
     * @return mixed
     */
    public function update(User $userLogado, Aeronave $aeronave)
    {
        return $userLogado->direcao;
    }

    /**
     * Determine whether the user can delete the aeronave.
     *
     * @param  \App\User  $user
     * @param  \App\Aeronave  $aeronave
     * @return mixed
     */
    public function delete(User $userLogado, Aeronave $aeronave)
    {
        return $userLogado->direcao;
    }

    /**
     * Determine whether the user can restore the aeronave.
     *
     * @param  \App\User  $user
     * @param  \App\Aeronave  $aeronave
     * @return mixed
     */
    public function restore(User $userLogado, Aeronave $aeronave)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the aeronave.
     *
     * @param  \App\User  $user
     * @param  \App\Aeronave  $aeronave
     * @return mixed
     */
    public function forceDelete(User $userLogado, Aeronave $aeronave)
    {
        //
    }
}
