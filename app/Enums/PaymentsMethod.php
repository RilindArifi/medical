<?php

namespace App\Enums;

use Kongulov\Traits\InteractWithEnum;

enum PaymentsMethod: string
{
    use InteractWithEnum;
    case CASH = 'Cash';
    case CREDIT_CARD = 'Credit card';
    case BANK_TRANSFER = 'Bank transfer';
    case OTHER = 'Other';
}
