<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Task extends Model
{
    use HasFactory;

    protected $fillable = ['description', 'user_id', 'state', 'priority', 'latitude', 'longitude'];

    
    public function user(){
        $this->belongsTo(User::class);
    }

    public function task(){
        $this->hasOne(Task::class);
    }
}
