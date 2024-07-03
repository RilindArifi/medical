<?php

namespace App\Models;

use App\Enums\AppointmentStatus;
use App\Traits\Scopable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Appointment extends Model implements HasMedia
{
    use HasFactory;
    use Scopable;
    use SoftDeletes;
    use InteractsWithMedia;

    protected $fillable = [
        'doctor_id',
        'patient_id',
        'date',
        'from',
        'to',
        'treatment',
        'notes',
        'status',
    ];

    public function casts(): array
    {
        return [
            'status' => AppointmentStatus::class
        ];
    }

    public function doctor(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function patient(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
