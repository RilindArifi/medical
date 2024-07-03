<?php

namespace App\Models;

use App\Traits\Scopable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Models\Role as ModelRoles;

class Role extends ModelRoles
{
    use HasFactory;
    use Scopable;
    use SoftDeletes;
}
