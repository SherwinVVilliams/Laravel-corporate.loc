<?php

namespace Corp\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;
class ArticleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if(Auth::check()){
            return Auth::user()->canDo('ADD_ARTICLES');
        }

        return false;
    }

    
    protected function getValidatorInstance()
    {
        $validator = parent::getValidatorInstance();
        //для получення обєкту валідатора звертаємось до родітєльского классу 

        $validator->sometimes('alias' , 'unique:articles|max:100', function($input){


            if($this->route()->hasParameter('article')){
                $model = $this->route()->parameter('article');
                return ($model->alias !== $input->alias) && !empty($input->alias);
            }

            return !empty($input->alias);
        });//вказуємо що данне поле можна вказувати можна не вказути, але якщо ми його вказали воно має пройти валідацію

        return $validator;
    }

    public function rules()
    {
        
        return [
            'title' => 'required|max:255',
            'text' => 'required',
            'category_id' => 'required|integer',
        ];
    }
}
