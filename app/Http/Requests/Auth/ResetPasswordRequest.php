<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class ResetPasswordRequest extends FormRequest
{

    /**
     * Determines if the user is authorized to make this request
     *
     * @return bool
     */
    public function authorize() : bool
    {
        return true;
    }

    /**
     * Gets the validation rules that apply to the request
     *
     * @return array
     */
    public function rules() : array
    {
        return [
            'token'    => ['required', 'string'],
            'email'    => ['required', 'email', 'exists:users'],
            'password' => ['required', 'confirmed', RegistrationRequest::passwordRules()],
        ];
    }

}
