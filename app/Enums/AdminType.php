<?php

namespace App\Enums;

enum AdminType: int
{
    case SUPER_ADMIN = 1;
    case ADMIN = 2;
    case MODERATOR = 3;
}
