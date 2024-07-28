<?php

namespace App\Services;

use App\Models\User;

class RoleService
{
    //busca todas los registros
    public function all()
    {
        return User::all();
    }
}
