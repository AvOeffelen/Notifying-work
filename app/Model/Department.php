<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $table = 'department';

    protected $fillable = ['name','company_id','manager_user_id'];

    public function Company()
    {
        return $this->belongsTo(Company::class);
    }

    public function User()
    {
        return $this->belongsToMany(User::class,'department_has_user','department_id','user_id');
    }

    public function Manager()
    {
        return $this->belongsTo(User::class,'manager_user_id');
    }
}
