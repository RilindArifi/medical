<?php

namespace App\Models;

use App\Enums\SalaryType;
use App\Enums\StatusGlobal;
use App\Traits\Scopable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmployeeSalary extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Scopable;

    protected $fillable = [
        'user_id',
        'salary',
        'salary_type',
        'bonus',
        'status',
        'date_hired',
        'salary_term'
    ];

    public function casts() :array
    {
        return [
            'status' => StatusGlobal::class,
            'salary_type' => SalaryType::class,
        ];
    }

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
