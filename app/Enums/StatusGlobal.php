<?php

namespace App\Enums;

use Kongulov\Traits\InteractWithEnum;
enum StatusGlobal: string
{
    use InteractWithEnum;
    case ACTIVE = 'Active';
    case INACTIVE = 'In Active';
}
