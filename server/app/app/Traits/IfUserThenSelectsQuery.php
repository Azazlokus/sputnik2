<?php

namespace App\Traits;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

trait IfUserThenSelectsQuery
{
    protected  function ifUserChangeQuery($query): void
    {
        $user = User::query()->find($this->getUserID());
        if ($user->isUser()) {
            $query->where('user_id', $user->id);
        }
    }
    protected  function ifUserShowYourself($query): void
    {
        $user = User::query()->find($this->getUserID());
        if ($user->isUser()) {
            $query->where('id', $user->id);
        }
    }

    protected function getUserID()
    {
        return Auth::user()->getAuthIdentifier();
    }
}
