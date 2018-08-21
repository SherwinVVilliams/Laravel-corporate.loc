<?php

namespace Corp;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public function users(){
    	return $this->belongsToMany('Corp\User', 'role_user');
    }

    public function permissions(){
    	return $this->belongsToMany('Corp\Permission', 'permission_role');
    }

    public function hasPermission($permission, $require = false){
    	 if(is_array($permission)){
    	 foreach($permission as $permName){
                $permName = $this->hasPermission($permName);// застосовуємо рекурсію
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
            foreach($this->permissions()->get() as $perm){
                if(str_is($permission, $perm->name)){
                    
                    return true;
                }
            }
        }
    }

    public function savePermissions($input){
        if(!empty($input)){
            $this->permissions()->sync($input);
        }
        else{
            $this->permissions()->detach();
        }

        return true;
    }
}
