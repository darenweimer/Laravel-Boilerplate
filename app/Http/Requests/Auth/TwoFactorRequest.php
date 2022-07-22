<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class TwoFactorRequest extends FormRequest
{
    /**
     * Determines if the user is authorized to make this request
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Gets the validation rules that apply to the request
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'two_factor_code' => ['required', 'string'],
        ];
    }

    /**
     * Configures the validator instance
     *
     * @param Validator $validator
     *
     * @return void
     */
    public function withValidator(Validator $validator): void
    {
        $validator->after(function ($validator) {
            if ($this->two_factor_code) {
                $verified = app('pragmarx.google2fa')
                    ->verifyGoogle2FA(
                        $this->user()?->two_factor_secret,
                        $this->two_factor_code
                    );

                if (!$verified) {
                    $validator->errors()
                        ->add(
                            'two_factor_code',
                            'The two-factor authentication code is incorrect.'
                        );
                }
            }
        });
    }
}
