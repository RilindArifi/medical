<?php

namespace App\Http\Requests;

use App\Enums\StatusGlobal;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class ScheduleRequest extends FormRequest
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
            'doctor_id'     => ['required'],
            'available_days' => ['required'],
            'from'          => ['required'],
            'to'            => ['required'],
            'notes'         => ['nullable'],
            'status'        => ['required', new Enum(StatusGlobal::class)],
        ];
    }
}
