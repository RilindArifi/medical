<?php

namespace App\Http\Requests;

use App\Enums\LeaveStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class LeaveRequest extends FormRequest
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
            'user_id'       => ['required'],
            'leave_type_id' => ['required'],
            'days'          => ['required'],
            'from'          => ['required'],
            'to'            => ['nullable'],
            'hours'         => ['nullable'],
            'duration'      => ['required'],
            'reason'        => ['nullable'],
            'status'        => ['required', new Enum(LeaveStatus::class)],
        ];
    }
}
