<?php

namespace App\Http\Requests;

use App\Enums\SalaryType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class EmployeeSalaryRequest extends FormRequest
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
        return [
            'user_id'     => ['required'],
            'salary'      => ['required'],
            'salary_type' => ['required', new Enum(SalaryType::class)],
            'bonus'       => ['nullable'],
            'status'      => ['required'],
            'salary_term' => ['nullable'],
            'date_hired'  => ['nullable']
        ];
    }
}
