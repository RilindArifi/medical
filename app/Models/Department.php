<?php

namespace App\Models;

use App\Enums\StatusGlobal;
use App\Traits\Scopable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Department extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Scopable;

    protected $fillable = [
        'name',
        'description',
        'date',
        'status',
    ];

    protected function casts() : array
    {
        return [
            'status' => StatusGlobal::class
        ];
    }

    public function doctors(): HasMany
    {
        return $this->hasMany(User::class);
    }
}
