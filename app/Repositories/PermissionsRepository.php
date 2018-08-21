<?php 
namespace Corp\Repositories;

use Corp\Permission;
use Auth; 
use Gate;
class PermissionsRepository extends Repository{

	protected $role_rep;

	public function __construct(Permission $perm, RolesRepository $role_rep){
		$this->model = $perm;
		$this->role_rep = $role_rep;
	}

	public function changePermissions($request){
		
        if(Auth::check()){
            if(Gate::denies('change', $this->model)){
                abort(403);
            }
        }

        $data = $request->except('_token');
        //dd($data);
        $roles = $this->role_rep->get();
        //dd($data);
        foreach($roles as $role){
        	if(isset($data[$role->id])){
        		$role->savePermissions($data[$role->id]);
        	}
        	else{
        		$role->savePermissions([]);//указуємо пустий массив щоб
        	}
        }

        return ['status' => 'Права обновленны'];
	}

}

?>