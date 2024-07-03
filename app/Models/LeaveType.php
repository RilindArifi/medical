<?php

namespace App\Models;

use App\Enums\StatusGlobal;
use App\Traits\Scopable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveType extends Model
{
    use HasFactory;
    use Scopable;

    protected $fillable = [
        'name' ,
        'status'
    ];

    public function casts(): array
    {
        return [
           'status' => StatusGlobal::class
        ];
    }
}
