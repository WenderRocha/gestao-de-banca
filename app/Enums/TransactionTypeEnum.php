<?php

namespace App\Enums;

enum TransactionTypeEnum: int
{
    case DEPOSIT  = 1;
    case WITHDRAW = 2;
    case TRANSFER = 3;
}
