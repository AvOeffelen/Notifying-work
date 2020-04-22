<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $table = 'company';


    public function User()
    {
        return $this->hasMany(User::class);
    }
    public function Department()
    {
        return $this->hasMany(Department::class);
    }
}
