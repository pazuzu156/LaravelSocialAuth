<?php

namespace App\Http\Requests;

class RegisterRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return !(\Auth::check());
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email'            => 'required|email|unique:accounts',
            'confirm-email'    => 'required|same:email',
            'password'         => 'required|min:6|max:12',
            'confirm-password' => 'required|same:password',
        ];
    }
}
