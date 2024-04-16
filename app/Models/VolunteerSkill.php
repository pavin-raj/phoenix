<?php

namespace App\Models;

use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class VolunteerSkill extends Model
{
    use HasFactory, Searchable;


    public $timestamps = FALSE;
    protected $fillable = ['user_id', 'skill'];

    public function toSearchableArray()
    {
        return [
        'user_id' => $this->user_id,
        'skill' => $this->skill,
    ];
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
