<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PlaceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'name' => 'required|max:255',
            'type' => 'required',
            'city' => 'required',
            'description' => 'nullable',
        ];

        if ($this->method() === 'PUT') {
            $rules['name'] = ['nullable','min:2','max:255'];
            $rules['type'] = ['nullable','min:2'];
            $rules['city'] = ['nullable','min:2'];
        }

        return $rules;
    }
}
