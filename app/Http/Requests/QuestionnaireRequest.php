<?php

namespace App\Http\Requests;

use App\Http\Requests\BaseRequest;

class QuestionnaireRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|min:3|max:255',
            'expiry_date' => 'required|date'
        ];
    }
}
