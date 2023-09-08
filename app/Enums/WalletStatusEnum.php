<?php

namespace App\Enums;

enum WalletStatusEnum: int
{
    case ACTIVE  = 1;
    case BLOCKED = 2;
    case FILED   = 3;
}
