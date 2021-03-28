<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class UpdateResetPasswordRequest extends FormRequest
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
            'password'  =>  'required|string|min:8|max:128|confirmed',
            'token'     =>  'bail|required|max:128|exists:password_resets,token'
        ];
    }


    protected function failedValidation(Validator $validator)
    {
        $key = $validator->errors()->keys()[0];
        $message = $validator->getMessageBag()->first();

        throw new ValidationException($validator, response()->json(['error' => 'true', 'detail' => ['key' => $key, 'message' => $message]], 400));
    }
}
