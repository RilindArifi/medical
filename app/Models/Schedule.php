<?php

namespace App\Models;

use App\Enums\StatusGlobal;
use App\Traits\Scopable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Schedule extends Model
{
    use HasFactory;
    use Scopable;
    use SoftDeletes;

    protected $fillable = [
        'doctor_id',
        'available_days',
        'from',
        'to',
        'notes',
        'status',
    ];

    public function casts(): array
    {
        return [
            'status' => StatusGlobal::class
        ];
    }

    public function doctor(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
