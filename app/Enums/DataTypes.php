<?php

namespace App\Enums;

use App\Enums\Concerns\HasValues;

enum DataTypes : string
{
    use HasValues;

    case String  = 'string';
    case Integer = 'integer';
    case Float   = 'float';
    case Decimal = 'decimal';
    case Array   = 'array';
    case Object  = 'object';
}
