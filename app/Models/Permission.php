<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Models\Permission as ModelPermissions;

class Permission extends ModelPermissions
{
    use HasFactory;
}
