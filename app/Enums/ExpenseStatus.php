<?php

namespace App\Enums;

use Kongulov\Traits\InteractWithEnum;

enum ExpenseStatus : string
{
    use InteractWithEnum;
    case PENDING = 'Pending';
    case APPROVED = 'Approved';
    case REJECTED    = 'Rejected';
    case CANCELLED   = 'Cancelled';
}
