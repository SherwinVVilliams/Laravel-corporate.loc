<?php

namespace Corp\Http\Controllers;

use Illuminate\Http\Request;
use Corp\Repositories\PortfoliosRepository;
use Config;

class PortfolioController extends SiteController
{
    
	public function __construct(PortfoliosRepository $p_rep){

      parent::__construct(new \Corp\Repositories\MenusRepository(new \Corp\Menu)); //передаємо обьєкт створеного нами репозиторія і в самий репозиторій передаєм обьєкт моделі
      $this->bar = 'no';//це буде впливати на шаблон
      $this->template = env('THEME').'.portfolios';
      
      $this->portfolio_rep = $p_rep;
    } 


    public function index(){

    	$portfolios = $this->getPortfolios(false, true);

    	$content = view(env('THEME').'.portfolios_content', ['portfolios' => $portfolios])->render();

    	$this->vars = array_add($this->vars, 'content', $content);
    	$this->SetMetaTags();

    	return $this->renderOutput();

    }

    public function show($alias){


    	$where = ['alias','!=', $alias];// вибираємо записи окрім тих на якому знаходимось
    	$portfolios = $this->getPortfolios(Config::get('settings.other_portfolios'),false, $where);//витягуємо записи (в данний час 6) ігноруючи той на якому ми знаходимось

    	$portfolio =$this->portfolio_rep->one($alias);
    	

    	if($portfolio){
            $portfolio->img = json_decode($portfolio->img);
        }

    	$content = view(env('THEME').'.portfolio_content', ['portfolio' => $portfolio, 'portfolios' => $portfolios])->render();

    	$this->vars = array_add($this->vars, 'content', $content);
    	
    	$this->setMetaTags();
    	return $this->renderOutput();
    }

    private function getPortfolios($take = false, $paginate = false, $where = false){
         $portfolios = $this->portfolio_rep->get("*", $take, $paginate, $where);

         if($portfolios){
         	$portfolios->load('filter');
         }

        return $portfolios;
    }

    private function SetMetaTags(){
        $this->keywords = 'Portfolios';
        $this->meta_desc = 'Portfolios';
        $this->title = 'Portfolios';
    }
}
