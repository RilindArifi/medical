<?php

namespace App\Enums;

use Kongulov\Traits\InteractWithEnum;

enum LeaveStatus : string
{
    use InteractWithEnum;
    case PENDING = 'Pending';
    case APPROVED = 'Approved';
    case REJECTED    = 'Rejected';
    case CANCELLED   = 'Cancelled';
}
