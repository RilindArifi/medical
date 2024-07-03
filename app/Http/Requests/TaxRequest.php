<?php

namespace App\Http\Requests;

use App\Enums\StatusGlobal;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class TaxRequest extends FormRequest
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
            'name'        => ['required'],
            'percentage'  => ['required'],
            'status'      => ['required', new Enum(StatusGlobal::class)],
            'information' => ['nullable'],
        ];
    }
}
