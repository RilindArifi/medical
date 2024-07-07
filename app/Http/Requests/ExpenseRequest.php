<?php

namespace App\Http\Requests;

use App\Enums\ExpenseStatus;
use App\Enums\LeaveStatus;
use App\Enums\PaymentsMethod;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class ExpenseRequest extends FormRequest
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
            'user_id'        => ['required'],
            'item_name'      => ['required'],
            'purchase_from'  => ['required'],
            'purchase_date'  => ['required'],
            'amount'         => ['required','integer','min:0','max:1000000000'],
            'information'    => ['nullable'],
            'paid_by'        => ['required', new Enum(PaymentsMethod::class)],
            'status'         => ['required', new Enum(ExpenseStatus::class)],
        ];
    }
}
