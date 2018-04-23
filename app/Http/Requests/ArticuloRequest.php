<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticuloRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            // 
            'titulo'=>'min:8|max:250|unique:articulos|required',
            'categoria_id'=>'required',
            'contenido'=>'min:60|required',
            'image'=>'required'

        ];
    }
}
