<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @param  \App\User  $model
     * @return mixed
     */
    public function view(User $userLogado, User $user)
    {
        return $userLogado->direcao;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $userLogado)
    {
        return $userLogado->direcao;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\User  $model
     * @return mixed
     */
    public function update(User $userLogado, User $user)
    {
        return ($userLogado->id == $user->id) || ($userLogado->direcao);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\User  $model
     * @return mixed
     */
    public function delete(User $userLogado, User $user)
    {
        return $userLogado->direcao;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\User  $model
     * @return mixed
     */
    public function restore(User $userLogado, User $user)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\User  $model
     * @return mixed
     */
    public function forceDelete(User $userLogado, User $user)
    {
        //
    }

    public function updatePassword(User $userLogado, User $user)
    {
        return $userLogado->id == $user->id;
    }

    public function viewPiloto(User $userLogado, User $user)
    {
        return $userLogado->direcao || $userLogado->tipo_socio == 'P';
    }

    public function viewMovimentos(User $userLogado, User $user)
    {
        return $userLogado->tipo_socio == 'P';
    }

    public function updateQuotaAtivo(User $userLogado, User $user)
    {
        return $userLogado->direcao;
    }
}
