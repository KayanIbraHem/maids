<?php

namespace App\Enums;

enum PhoneStatus: int
{
    case NOT_VERIFIED = 0;
    case VERIFIED = 1;
}
