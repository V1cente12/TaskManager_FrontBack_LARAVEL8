<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shifts extends Model
{
    use HasFactory;

    protected $fillable = [
    'user_id',
    'task_id', 
    'completed_at',
    'validated_by'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function task(){
        return $this->belongsTo((Task::class));
    }

    public function validator(){
        return $this->belongsTo(User::class, 'validated_by');
    }
}
