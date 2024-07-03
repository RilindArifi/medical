<?php

namespace App\Enums;

use Kongulov\Traits\InteractWithEnum;

enum SalaryType: string
{
    use InteractWithEnum;
    case NETO = 'Neto';
    case BRUTO = 'Bruto';
}
