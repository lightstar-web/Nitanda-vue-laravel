<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use Tymon\JWTAuth\Contracts\JWTSubject;

use App\Models\DepartmentMaster;
use App\Models\RoleMaster;
use App\Models\Question;
use App\Models\Answer;
use App\Models\QAFollow;

class User extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'employee_name',
        'employee_id',
        'login_id',
        'password',
        'avatar_url',
        'hire_date',
        'leave_date',
        'affiliation',
        'role',
        'grade',
        'note',
        'mygoal',
        'department_id',
        'grade',
        'del_flag'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier() {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims() {
        return [];
    }    

    public function departmentMaster() {
        return $this->belongsTo(DepartmentMaster::class, 'department_id');
    }
    
    public function roleMaster() {
        return $this->belongsTo(RoleMaster::class, 'role_id');
    }

    public function question() {
        return $this->hasMany(Question::class);
    }

    public function answer() {
        return $this->hasMany(Question::class);
    }

    public function qafollow() {
        return $this->hasMany(QAFollow::class);
    }
}