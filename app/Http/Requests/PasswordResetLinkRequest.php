<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class PasswordResetLinkRequest extends FormRequest
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
            'email' => 'required'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $key = $validator->errors()->keys()[0];
        $message = $validator->getMessageBag()->first();

        throw new ValidationException($validator, response()->json(['error' => 'true', 'detail' => ['key' => $key, 'message' => $message]]));
    }
}
