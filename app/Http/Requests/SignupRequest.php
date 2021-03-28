<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class SignupRequest extends FormRequest
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
            'first_name'        =>  'bail|required|string|min:3|max:32',
            'middle_name'       =>  'bail|nullable|string|min:3|max:32',
            'last_name'         =>  'bail|required|string|min:3|max:32',
            'password'          =>  'bail|required|string|min:8|max:128|confirmed',
            'email'             =>  'bail|required|email|unique:users,email',
            'dob'               =>  'bail|required|date_format:Y-m-d',
            'country'           =>  'bail|required|exists:countries,iso',
            'city'              =>  'bail|required|string|min:5|max:64',
            'address'           =>  'bail|required|string|min:5|max:128',
            'contact_number'    =>  'bail|required|numeric|digits_between:5,15'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $key = $validator->errors()->keys()[0];
        $message = $validator->getMessageBag()->first();

        throw new ValidationException($validator, response()->json(['error' => 'true', 'detail' => ['key' => $key, 'message' => $message]], 400));
    }
}
