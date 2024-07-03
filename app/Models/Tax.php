<?php

namespace App\Models;

use App\Enums\StatusGlobal;
use App\Traits\Scopable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tax extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Scopable;

    protected $fillable = [
        'name',
        'percentage',
        'status',
        'information',
    ];

    public function casts(): array
    {
        return [
          'status' => StatusGlobal::class
        ];
    }
}
