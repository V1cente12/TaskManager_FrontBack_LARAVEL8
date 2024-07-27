<?php

namespace App\Services;

use App\Models\Role;

class RoleService
{
    //buscar registro por tarea
    public function findRolbyId($user_id)
    {
        return Role::where('user_id', $user_id)
            ->with(['user'])
            ->get();
    }

    //busca todas los registros
    public function all()
    {
        return Role::all();
    }
}
