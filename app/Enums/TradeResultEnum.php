<?php

namespace App\Enums;

enum TradeResultEnum: string
{
    case WIN  = 'win';
    case LOSS = 'loss';
    case DRAW = 'draw';
}
