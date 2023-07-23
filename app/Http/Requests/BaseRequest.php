<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

abstract class BaseRequest extends FormRequest
{
    /**
     * Format the errors from the given Validator instance.
     *
     * @param  \Illuminate\Contracts\Validation\Validator  $validator
     * @return array
     */
    protected function formatErrors(Validator $validator)
    {
        return $validator->getMessageBag()->toArray();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        $rules = [];

        if (in_array($this->method(), ['PUT', 'PATCH'])) {
            $rules = $this->update();
        } elseif ($this->method() == 'POST') {
            $rules = $this->store();
        }

        return $rules;
    }

    /**
     * Get the validation rule that apply to store request
     *
     * @return array
     */
    protected function store(): array
    {
        return [];
    }

    /**
     * Get the validation rule that apply to update request
     *
     * @return array
     */
    protected function update(): array
    {
        return $this->store();
    }
}
