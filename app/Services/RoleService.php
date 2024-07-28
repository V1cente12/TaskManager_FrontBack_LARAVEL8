<?php

namespace App\Services;

use App\Models\Role;

class RoleService
{
    //busca todas los registros
    public function all()
    {
        return Role::all();
    }
}
