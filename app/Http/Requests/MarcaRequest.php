<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MarcaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    // public function authorize()
    // {
    //     // return false;
    // }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id = request('id') ? request('id') : NULL; //To identify if request is for add or edit just take autoincremented id parameter form request.         

        switch ($this->method()){
            case 'POST':
                // break;
            case 'PUT':
            
                //break;
            case 'PATCH':
                return [
                    'descripcion' =>'required|min:3|max:50|unique:marcas,descripcion,'.$id
                ];
            break;
        }
    }

    public function messages()
    {
        return [
            "descripcion.required" => "La descripcion es requerida",
            "descripcion.unique" => "La descripcion debe ser única",            
        ];
    }

    public function attributes()
    {
        return [
            'descripcion' => 'Descripcion de la marca',
        ];
    }
}
