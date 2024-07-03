<?php

namespace App\Models;

use App\Enums\LeaveStatus;
use App\Traits\Scopable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Leave extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Scopable;

    protected $fillable = [
        'user_id',
        'leave_type_id',
        'days',
        'from',
        'to',
        'hours',
        'duration',
        'reason',
        'status',
    ];

    public function casts(): array
    {
        return [
            'status' => LeaveStatus::class
        ];
    }

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function leave_type():BelongsTo
    {
        return $this->belongsTo(LeaveType::class);
    }
}
