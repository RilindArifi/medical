<?php

namespace App\Http\Requests;

use App\Enums\Gender;
use App\Enums\StatusGlobal;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;
use Illuminate\Validation\Rules\Password;

class DoctorRequest extends FormRequest
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
        $doctor = ($param = $this->route()->parameter('doctor')) && $param instanceof User ? $param : null;

        return [
            'department_id' => ['required'],
            'first_name' => ['required', 'string', 'max:255'],
            'last_name'  => ['required', 'string', 'max:255'],
            'email'      => ['required', 'email','string', 'max:255', Rule::unique('users')->ignore($doctor?->id)],
            'password'   => [Rule::when($doctor?->id , 'nullable' , 'required'), request()->password ? 'confirmed' : '', Password::min(8)],
            'mobile'        => ['required'],
            'dob'        => ['required','date'],
            'gender'     => ['required', new Enum(Gender::class)],
            'education'  => ['required', 'string'],
            'address'    => ['required', 'string'],
            'country'    => ['nullable', 'string'],
            'city'       => ['nullable', 'string'],
            'postal_code'=> ['required'],
            'status'     => ['required', new Enum(StatusGlobal::class)],
            'avatar'     => ['nullable']
        ];
    }
}
