<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use App\Role;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        //"date" => "datetime:m/Y"
    ];

    public function role(){
        return $this->belongsTo("App\Role", "role_id");
    }

    public function isAdmin()
    {
        $user = User::find(auth()->user()->id);
        $role = $user->role()->first()->name;

        if($role==="admin"){
            return true;
        }
        else{
            return false;
        }
        
    }

    public function isUser()
    {
        $user = User::find(auth()->user()->id);
        $role = $user->role()->first()->name;

        if($role==="user"){
            return true;
        }
        else{
            return false;
        }
        
    }
    
}
