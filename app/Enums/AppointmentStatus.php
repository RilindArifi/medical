<?php

namespace App\Enums;

use Kongulov\Traits\InteractWithEnum;
enum AppointmentStatus: string
{
    use InteractWithEnum;
    case APPROVED = 'Approved';
    case PENDING = 'Pending';
    case REJECTED = 'Rejected';
}
