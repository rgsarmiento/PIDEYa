<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDocumentRequest extends FormRequest
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
        'customer_id' => 'required',
        'products' => 'required',
        'total' => 'required'        
        ];
    }


    public function messages()
    {
        return [
        'customer_id.required' => 'Se requiere un cliente',
        'products.required' => 'Se requiere almenos 1 producto',
        'total.required' => 'Se requiere un total'

            ];
    }
}
