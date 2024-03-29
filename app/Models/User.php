<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Scout\Searchable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\DB;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, Searchable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'image',
        'password',
        'role_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    

    public function tasks(){
        return $this->hasMany(Task::class);
    }

    public function role(){
        return $this->belongsTo(Role::class);
    }

    public function messaages(){
        return $this->hasMany(Message::class);
    }

    public function volunteer_skills(){
        return $this->hasMany(VolunteerSkill::class);
    }

    public function assignees(){
        return $this->hasMany(Assignee::class);
    }


    public function toSearchableArray()
    {
        return [
        'name' => $this->name,
        'role_id' => (int) $this->role_id,
        'volunteer_skills' => $this->volunteer_skills(),
    ];
    }
    

    public function hasRole($role)
    {
        $current_role = DB::table('users')
        ->join('roles', function (JoinClause $join) {
            $join->on('users.role_id', '=', 'roles.id')
                 ->where('users.id', '=', $this->id);
        })
        ->select('roles.name')
        ->get();

        
        return in_array($role,$current_role->pluck('name')->toArray());
    }
}
