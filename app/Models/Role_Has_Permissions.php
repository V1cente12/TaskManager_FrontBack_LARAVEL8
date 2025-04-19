<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role_Has_Permissions extends Model
{
    use HasFactory;

    protected $table = 'role_has_permissions';
    protected $fillable = [
        'role_id',
        'user_id',
    ];

    public function role(){
        return $this->belongsTo(Role::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}