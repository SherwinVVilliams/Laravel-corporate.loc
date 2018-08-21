<?php 

namespace Corp\Repositories;

use Corp\Menu;

class MenusRepository extends Repository{

	public function __construct(Menu $menu){
		$this->model = $menu;
	}

	public function getChildMenu(){
    
    $child_menu = $this->model->where('parent', '>', '0')->get();

    return $child_menu;
    }

}


?>