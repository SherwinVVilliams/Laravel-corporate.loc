<?php

namespace Corp\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Auth;
use Response;
use Corp\Comment;
use Corp\Article;

class CommentController extends SiteController
{

    public function store(Request $request)
    {
        $data = $request->except('_token', 'comment_post_ID', 'comment_parent');

        $data['article_id'] = $request->input('comment_post_ID');
        $data['parent_id'] = $request->input('comment_parent');

        $validator = Validator::make($data, [
            'article_id' => 'integer|required',
            'parent_id' => 'integer|required',
            'text' => 'string|required',
        ]);// для авторизованого

        $validator->sometimes(['name', 'email'], 'required|max:255',
         function($input){
            return !Auth::check();
        });

        if($validator->fails()){

            return Response::json(['error' => $validator->errors()->all()]);//формуємо відповідь для аякс запроса з массивом помилок 
        }


        $comment = new Comment($data);
        if(Auth::check()){
            $comment->user_id = Auth::user()->id;// якщо є авторизований користувач то при добавленні вказуємо його id в user_id
            $comment->name = Auth::user()->name;
            $comment->email = Auth::user()->email;
            $comment->site = 'corporate.loc';
        }
        //dd($comment);
        $post = Article::find($data['article_id']);

        $post->comments()->save($comment);


        //підготовлюємо інформацію для вивода на сторінку 
        $comment->load('user');

        $data['id'] = $comment->id;

        $data['email'] = (!empty($data['email'])) ? $data['email'] : $comment->user->email;
        $data['name'] = (!empty($data['name'])) ? $data['name'] : $comment->user->name;
        $data['hash'] = md5($data['email']);
        //dd($data);
        $view_comment = view(env('THEME').'.one_comment', ['data' => $data])->render(); //звертаємось до шаблону вивода 1 коментаря для полегшення завдання


        return Response::json(['success' => TRUE, 'comment' => $view_comment, 'data' => $data]);

        exit();

    }


}
