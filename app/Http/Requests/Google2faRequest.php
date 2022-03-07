<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Google2faRequest extends FormRequest
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
        if ($google2fa = $this->input('google2fa')) {
            $verified = app('pragmarx.google2fa')
                ->verifyGoogle2FA(
                    $this->user()->google2fa_secret, $google2fa
                );
        }

        return [
            'google2fa' => [
                'required',
                fn($attr, $val, $fail) => ($verified ?? false) ? null
                    : $fail('The Google 2FA code is incorrect.'),
            ],
        ];
    }

}
