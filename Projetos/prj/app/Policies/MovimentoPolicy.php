<?php

namespace App\Policies;

use App\User;
use App\Movimento;
use Illuminate\Auth\Access\HandlesAuthorization;

class MovimentoPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the movimento.
     *
     * @param  \App\User  $user
     * @param  \App\Movimento  $movimento
     * @return mixed
     */
    public function view(User $userLogado, Movimento $movimento)
    {
        return $movimento->confirmado == '0' && ($userLogado->direcao || $movimento->piloto_id == $userLogado->id || $movimento->instrutor_id == $userLogado->id) ;
    }

    /**
     * Determine whether the user can create movimentos.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $userLogado)
    {
        return $userLogado->direcao || $userLogado->tipo_socio == 'P';
    }

    /**
     * Determine whether the user can update the movimento.
     *
     * @param  \App\User  $user
     * @param  \App\Movimento  $movimento
     * @return mixed
     */
    public function update(User $userLogado, Movimento $movimento)
    {
        return $movimento->confirmado == '0' && ($userLogado->direcao || $movimento->piloto_id == $userLogado->id || $movimento->instrutor_id == $userLogado->id);
    }

    /**
     * Determine whether the user can delete the movimento.
     *
     * @param  \App\User  $user
     * @param  \App\Movimento  $movimento
     * @return mixed
     */
    public function delete(User $userLogado, Movimento $movimento)
    {
        return $movimento->confirmado == '0' && ($userLogado->direcao || $movimento->piloto_id == $userLogado->id || $movimento->instrutor_id == $userLogado->id);
    }

    /**
     * Determine whether the user can restore the movimento.
     *
     * @param  \App\User  $user
     * @param  \App\Movimento  $movimento
     * @return mixed
     */
    public function restore(User $userLogado, Movimento $movimento)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the movimento.
     *
     * @param  \App\User  $user
     * @param  \App\Movimento  $movimento
     * @return mixed
     */
    public function forceDelete(User $userLogado, Movimento $movimento)
    {
        //
    }

    public function confirmar(User $userLogado, Movimento $movimento)
    {
        return $movimento->confirmado == '0' && $userLogado->direcao;
    }
}
