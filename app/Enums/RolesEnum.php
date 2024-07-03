<?php

namespace App\Enums;

use Kongulov\Traits\InteractWithEnum;

enum RolesEnum: string
{
    use InteractWithEnum;
    case ADMIN             = 'Admin';
    case DOCTOR           = 'Doctor';
    case PATIENT          = 'Patient';
}
