<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RoleRequest extends FormRequest
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
            'name' => ['required', 'string'],
            'permissions' => ['nullable', 'array'],
            'permissions.*' => ['string', 'distinct', 'exists:permissions,name'],
        ];

        if ($this->route('role')) {
            $rules['name'][] = Rule::unique('roles')->ignore($this->route('role'));
        } else {
            $rules['name'][] = 'unique:roles,name';
        }

        return $rules;
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'name' => __('name'),
            'permissions' => __('permissions'),
            'permissions.*' => __('permission'),
        ];
    }
}
