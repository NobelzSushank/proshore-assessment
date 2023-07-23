<?php

namespace App\Http\Requests;

use App\Http\Requests\BaseRequest;

class LoginRequest extends BaseRequest
{
     /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'email'=>'required|string|max:255|exists:users,email',
            'password'=>'required',
        ];
    }
}
