<?php

namespace App;

use App\Model\Company;
use App\Model\Department;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use NotificationChannels\WebPush\HasPushSubscriptions;

class User extends Authenticatable
{
    use Notifiable;
    use HasPushSubscriptions;
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
    ];

    public function Company()
    {
        return $this->belongsTo(Company::class);
    }

    public function Department()
    {
        return $this->belongsToMany(Department::class,'department_has_user','user_id','department_id');
    }

    public function DepartmentManager()
    {
        return $this->hasMany(Department::class);
    }


    const SUPERADMIN_TYPE = 'sysadmin';
    const OWNER_TYPE = 'owner';
    const DEPARTMENTLEADER_TYPE = 'department_leader';
    const DEFAULT_TYPE = 'default';


    public function isSuperAdmin()
    {
        return $this->type === SELF::SUPERADMIN_TYPE;
    }
    public function isOwner()
    {
        return $this->type === SELF::OWNER_TYPE;
    }
    public function isDepartmentLeader()
    {
        return $this->type === SELF::DEPARTMENTLEADER_TYPE;
    }
    public function isDefault()
    {
        return $this->type === SELF::DEFAULT_TYPE;
    }

}
