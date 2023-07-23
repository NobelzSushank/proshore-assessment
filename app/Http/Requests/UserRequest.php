<?php

namespace App\Http\Requests;

use App\Http\Requests\BaseRequest;

class UserRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the post request.
     *
     * @return array
     */
    public function store(): array
    {
        return [
            'name' => 'required|string',
            "email" => "required|email|unique:users,email",
            "password" => "required|min:8",
            "role_id" => "required|string|exists:roles,id"
        ];
    }

    /**
     * Get the validation rules that apply to the put request.
     *
     * @return array
     */
    public function update(): array
    {
        return [
            "name" => "required|string",
            "email" => "required|email|exists:users,email,".$this->user,
            "password" => "nullable|min:8",
            "role_id" => "required|string|exists:roles,id"
        ];
    }
}
