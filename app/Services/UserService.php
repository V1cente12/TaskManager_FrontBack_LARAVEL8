<?php

namespace App\Services;

use App\Models\User;

class UserService
{
    //busca todas los registros
    public function all()
    {
        return User::all();
    }

    //buscar usuario por id
    public function find($id)
    {
        $user = User::find($id);
        $user->role = $user->roles->first();
        return $user;
    }
}
