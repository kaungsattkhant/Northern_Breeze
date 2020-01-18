<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticable;
use Illuminate\Routing\Route;

class Staff extends Authenticable
{
    public $timestamps=false;
    protected $fillable=['name','email','role','password','password_confirmation','branch_id'];
    public function role()
    {
        return $this->belongsTo(Role::class);
    }
    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }
    public function isAdmin(){
        foreach ($this->role()->get() as $role)
        {
            if ($role->name == 'Admin')
            {
                return true;
            }
        }
    }
    public function isManager(){
        foreach ($this->role()->get() as $role)
        {
            if ($role->name == 'Manager')
            {
                return true;
            }
        }
    }
    public function isFrontMan(){
        foreach ($this->role()->get() as $role)
        {
            if ($role->name == 'Front Man')
            {
                return true;
            }else{
                return false;
            }
        }
    }
    public function role_name($role_id){
        $roleName=Role::find($role_id);
        return $roleName->name;
    }

}
