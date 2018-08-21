<?php

namespace Corp\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        if($this->isHttpException($exception)){
            $statusCode = $exception->getStatusCode();
            if($statusCode == 404){
                
                $obj = new \Corp\Http\Controllers\SiteController(new \Corp\Repositories\MenusRepository(new \Corp\Menu));
                $navigation = $navigation = view(env('THEME').'.navigation', ['child_menu' => $obj->getChildMenu($obj->getMenu()), 'menu' => $obj->getMenu()])->render();
                
                \Log::alert('Cтранница не найдена - '.$request->url());

                $content = view(env('THEME').'.404')->render();
                $footer = view(env('THEME').'.footer')->render();

                return response()->view(env('THEME').'.error', ['navigation'=> $navigation, 'content' => $content, 'footer' => $footer, 'meta_desc' => 'Page is Not Found', 'keywords' => 'Page is Not Found', 'title' => 'Page is Not Found', 'bar' => 'no']);
            }
        }
        return parent::render($request, $exception);
    }
}
