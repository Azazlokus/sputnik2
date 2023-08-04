<?php

namespace App\Enums;
use App\Traits\EnumTrait;

enum RoleEnum
{
    use EnumTrait;
    const Admin = 'Administrator';
    const User = 'User';
    const UserBlocked = 'User_blocked';
}
