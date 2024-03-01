<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskContact extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = ['task_id', 'phone', 'email'];

    public function task(){
        return $this->hasOne(Task::class);
    }
}
