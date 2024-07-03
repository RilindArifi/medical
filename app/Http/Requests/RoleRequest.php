<?php

namespace App\Http\Requests;

use App\Models\Role;
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
        $role = ($param = $this->route()->parameter('role')) && $param instanceof Role ? $param : null;

        return [
            'name' => ['required',Rule::unique('roles')->ignore($role?->id)],
            'permissions' => ['nullable']
        ];
    }
}
