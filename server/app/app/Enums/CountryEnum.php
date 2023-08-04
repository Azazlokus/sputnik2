<?php

namespace App\Enums;
use App\Traits\EnumTrait;

enum CountryEnum
{
    use EnumTrait;
    const Russia = 'Russia';
    const USA = 'USA';
    const England = 'England';
}
