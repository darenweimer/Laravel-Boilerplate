<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TwoFactorRequest extends FormRequest
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
        if ($two_factor_code = $this->input('two_factor_code')) {
            $verified = app('pragmarx.google2fa')
                ->verifyGoogle2FA(
                    $this->user()?->two_factor_secret, $two_factor_code
                );
        }

        return [
            'two_factor_code' => [
                'required',
                fn($attribute, $value, $failCallback) => ($verified ?? false)
                    ? null
                    : $failCallback('The two-factor authentication code is incorrect.'),
            ],
        ];
    }

}
