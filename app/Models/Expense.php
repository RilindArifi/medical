<?php

namespace App\Models;

use App\Enums\PaymentsMethod;
use App\Enums\ExpenseStatus;
use App\Traits\Scopable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Expense extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Scopable;

    protected $fillable = [
        'user_id',
        'item_name',
        'purchase_from',
        'purchase_date',
        'amount',
        'information',
        'paid_by',
        'status',
    ];

    public function casts(): array
    {
        return [
            'paid_by' => PaymentsMethod::class,
            'status' => ExpenseStatus::class,
        ];
    }

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
