<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Task extends Model
{
    use HasFactory;

    protected $fillable = ['description', 'user_id', 'status', 'priority', 'latitude', 'longitude', 'city', 'state'];

    
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function task_contact(){
        return $this->hasOne(TaskContact::class);
    }
}
