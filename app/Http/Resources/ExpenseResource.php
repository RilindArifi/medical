<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ExpenseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        /* @var \App\Models\Expense $expense */

        $expense = $this->resource;

        $data['id'] = $expense->id;
        $data['user_id'] = $expense->user_id;
        $data['item_name'] = $expense->item_name;
        $data['purchase_from'] = $expense->purchase_from;
        $data['purchase_date'] = parse_date($expense->purchase_date);
        $data['amount'] = $expense->amount;
        $data['information'] = $expense->information;
        $data['paid_by'] = $expense->paid_by;
        $data['status'] = $expense->status;

        $data['user'] = user($expense->user);

        return $data;
    }
}
