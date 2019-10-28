<?php

namespace App\Http\Requests;

use App\Rules\ValidPhoneNumber;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class RegisterUserRequest extends FormRequest
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
            'email'        => [
                Rule:: requiredIf(empty($this->phone_number)),
                'bail',
                'email',
                'max:255',
                'unique:users'
            ],
            'phone_number' => [
                Rule:: requiredIf(empty($this->email)),
                'bail',
                new ValidPhoneNumber,
                'unique:users'
            ],
            'first_name'   => ['required', 'string', 'max:255'],
            'last_name'    => ['required', 'string', 'max:255'],
            'password'     => ['required', 'string', 'min:8', 'confirmed'],
        ];
    }
}
