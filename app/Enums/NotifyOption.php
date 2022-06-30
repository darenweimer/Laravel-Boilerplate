<?php

namespace App\Enums;

use App\Enums\Concerns\HasValues;

enum NotifyOption : string
{
    use HasValues;

    case None  = 'none';
    case Email = 'email';
    case Text  = 'text';
    case Both  = 'both';
}
