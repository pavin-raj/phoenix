<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assignee extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $guarded = [];

    public function task(){
        return $this->belongsTo(Task::class);
    }
}
