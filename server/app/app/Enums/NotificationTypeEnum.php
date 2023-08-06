<?php

namespace App\Enums;
use App\Traits\EnumTrait;

enum NotificationTypeEnum
{
    use EnumTrait;
    const Push = 'Push';
    const Mail = 'Mail';
}
