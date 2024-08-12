<?php

namespace App\Services;

use App\Models\Role_Has_Permissions;

class RoleHasPermissionsService
{
    //busca todas los registros
    public function all(){
        return Role_Has_Permissions::all();
    }
    
    //permisos por id permisos
}
