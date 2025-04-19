<?php

namespace App\Services;

use App\Models\Role_Has_Permissions;
use App\Models\Role;

class RoleHasPermissionsService
{
    //busca todas los registros
    public function all(){
        return Role_Has_Permissions::all();
    }
    
    public function userHasRole($userId){
        return Role_Has_Permissions::where('user_id', $userId)->exists();
    }

    public function getAllRoles(){
        return Role::all();
    }

    public function assignRole($userId, $roleId){
        return Role_Has_Permissions::create([
            'user_id' => $userId,
            'role_id' => $roleId
        ]);
    }
}