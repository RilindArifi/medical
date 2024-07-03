<?php

namespace App\Http\Requests;

use App\Enums\AppointmentStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class AppointmentRequest extends FormRequest
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
            $data['doctor_id']  = ['nullable'];
            $data['patient_id'] = ['nullable'];
            $data['date']       = ['required'];
            $data['from']       = ['required'];
            $data['to']         = ['required'];
            $data['treatment']  = ['required'];
            $data['notes']      = ['nullable'];
            $data['status']     = ['nullable', new Enum(AppointmentStatus::class)];

            if(!request('patient_id')) {
                $data['first_name']    = ['required'];
                $data['last_name']     = ['required'];
                $data['email']         = ['required'];
                $data['mobile']        = ['required'];
                $data['dob']           = ['nullable'];
                $data['gender']        = ['nullable'];
                $data['password']      = ['required'];
            }

            return $data;
    }
}
