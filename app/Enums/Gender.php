<?php

namespace App\Enums;

use Kongulov\Traits\InteractWithEnum;

enum Gender: string
{
    use InteractWithEnum;
    case MALE = 'Male';
    case FEMALE = 'Female';
}
