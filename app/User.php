<?php

namespace Corp;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

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

    public function articles(){
        return $this->hasMany('Corp\Article');
    }

    public function roles(){
        return $this->belongsToMany('Corp\Role', 'role_user');
    }

    //метод для перевірки превілегій
    //в require ми передаємо true тільки коли всі передані права будуть доступні для зареєстрованого користувача
    public function canDo($permission, $require = false){
         
         if(is_array($permission)){
            foreach($permission as $permName){
                $permName = $this->canDo($permName);// застосовуємо рекурсію
                if($permName && !$require){
                    return true;
                }
                else if($require && !$permName){
                    return false;
                }
            }

            return $require;
        }
        else{// якщо передали строку
           foreach($this->roles()->get() as $role){
                foreach($role->permissions()->get() as $perm){
                    if(str_is($permission, $perm->name)){// порівнюємо строку яку ми передали і значення в таблиці permissions
                    
                        return true;
                    }
                }
            }
        }
    }

    //метод для перевірки ролей користувача
     public function hasRole($name, $require = false){
         if(is_array($name)){
            foreach($name as $roleName){
                $hasRole = $this->hasRole($roleName);// застосовуємо рекурсію
                if($hasRole && !$require){
                    return true;
                }
                else if($require && !$hasRole){
                    return false;
                }
            }

            return $require;
        }
        else{// якщо передали строку
           foreach($this->roles()->get() as $role){
                if($role->name == $name){
                    
                    return true;
                }
            }
        }
    }
}
