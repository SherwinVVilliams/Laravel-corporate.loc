<?php

namespace Corp\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use Session;

class ContactController extends SiteController
{

	public function __construct(){
      parent::__construct(new \Corp\Repositories\MenusRepository(new \Corp\Menu)); //передаємо обьєкт створеного нами репозиторія і в самий репозиторій передаєм обьєкт моделі
      $this->bar = 'left';//це буде впливати на шаблон
      $this->template = env('THEME').'.contact';

    } 

    public function index(Request $request){


    	if($request->isMethod('post')){

    		$validator = $this->validate($request,[
    			'name' => 'required|max:255',
    			'email' => 'required|email',
    			'text' => 'required'
    		]);

    		if($validator){
    			$data = $request->all();
	    		$result = Mail::send(['text' => 'pink.email'],['data'=> $data ],function($message){
	    		$message->to('thenetishin@gmail.com', 'To YOU')->subject('Test mail');
	    		$message->from('thenetishin@gmail.com', 'To YOU');
    			});
                Session::flash("key", "Message is Send");
    			if($result){
                    
    				return redirect()->route('contact')->with('key', 'message is Send');
    			}
    		}	
    	}
    	$content = view(env('THEME').'.contact_content')->render();
        $bar = view(env('THEME').'.contact_sidebar')->render();

        $this->vars = array_add($this->vars, 'sidebar', $bar);
    	$this->vars = array_add($this->vars, 'content', $content);

        $this->SetMetaTags();

        return $this->renderOutput();
    }


    private function SetMetaTags(){
        $this->keywords = 'Contact';
        $this->meta_desc = 'Contact';
        $this->title = 'Contact';
    }
}
