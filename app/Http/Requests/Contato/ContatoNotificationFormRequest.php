<?php

namespace App\Http\Requests\Contato;

use Illuminate\Foundation\Http\FormRequest;

class ContatoNotificationFormRequest extends FormRequest
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
            'mensagem'              => 'required',
            'email'                 => 'required|email',
            'g-recaptcha-response'  => 'required|recaptcha',
        ];
    }


    public function messages()
     {
         return [
            'mensage.required'     => 'Insira a mensagem para enviar',
            'email.required'       => 'Insira um email',
            'email.email'          => 'Insira um email valido',
            'g-recaptcha-response' => 'clique no recaptcha',
         ];
     }
}
