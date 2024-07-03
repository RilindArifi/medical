<?php

namespace App\Http\Requests;

use App\Enums\Gender;
use App\Enums\StatusGlobal;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;
use Illuminate\Validation\Rules\Password;

class PatientRequest extends FormRequest
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
        $patient = ($param = $this->route()->parameter('patient')) && $param instanceof User ? $param : null;

        return [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name'  => ['required', 'string', 'max:255'],
            'email'      => ['required', 'email','string', 'max:255', Rule::unique('users')->ignore($patient?->id)],
            'password'   => [Rule::when($patient?->id , 'nullable' , 'required'), request()->password ? 'confirmed' : '', Password::min(8)],
            'mobile'     => ['required'],
            'dob'        => ['nullable','date'],
            'gender'     => ['nullable', new Enum(Gender::class)],
            'address'    => ['nullable', 'string'],
            'country'    => ['nullable', 'string'],
            'city'       => ['nullable', 'string'],
            'postal_code'=> ['nullable'],
            'status'     => ['required', new Enum(StatusGlobal::class)],
            'avatar'     => ['nullable']
        ];
    }
}
