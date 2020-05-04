<?php

namespace App\Http\Requests;

use App\Http\Model\PublisherModel;
use Illuminate\Foundation\Http\FormRequest;

class PublishRequest extends FormRequest
{

    //protected $redirect = false;
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {

        //$comment = PublisherModel::find($this->route('publish'));
        return true; //&& $this->user()->can('update', $comment);

    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title'=>'required|max:5',
            'num'=>'required|numeric'
        ];
    }

    public function messages()
    {
       return [
         'title.required'=>'标题不能未空'
       ];
    }

}
