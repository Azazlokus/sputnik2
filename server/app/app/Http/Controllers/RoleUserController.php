<?php

namespace App\Http\Controllers;


use App\Http\Requests\RoleUserRequest;
use App\Http\Resources\RoleUserResource;
use App\Models\RoleUser;
use App\Models\User;
use App\Models\UserNotification;
use App\Policies\RoleUserPolicy;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Orion\Http\Controllers\Controller;


/*
 * Я бы тут хотел прикопаться к неймингу, из названия, я бы подумал, что мы создаём и работаем с сущностью Role,
 * однако, смотря на методы и прочий функционал, 2 метода по отправке сообщений юзеру, тут и Notifications и Roles
 * не понял, что здесь происходит
 */
class RoleUserController extends Controller
{

    protected $model = RoleUser::class;
    protected $request = RoleUserRequest::class;
    protected $resource = RoleUserResource::class;
    protected $policy = RoleUserPolicy::class;

    protected function buildIndexFetchQuery($request, array $requestedRelations): Builder
    {
        $query = parent::buildIndexFetchQuery($request, $requestedRelations);
        $this->ifUserChangeQuery($query);
        return $query;
    }

    protected function buildStoreFetchQuery($request, array $requestedRelations): Builder
    {
        $query = parent::buildIndexFetchQuery($request, $requestedRelations);
        $this->sendBlockNotifications($this->getUserID());
        return $query;
    }

    protected function buildDestroyFetchQuery($request, array $requestedRelations, bool $softDeletes): Builder
    {
        $query = parent::buildIndexFetchQuery($request, $requestedRelations);
        $this->sendUnblockNotifications($this->getUserID());
        return $query;
    }

    /*
     * sendBlockNotifications и sendUnblockNotifications, оба метода не используются вне этого класса, значит модификаторы доступа private/protected
     *
     * А еще я думаю, надо бы такую логику выносить на уровень моделей, у нас типа "толстые модели", и там должна
     * быть сосредоточена основная бизнес-логика
     */
    public function sendBlockNotifications($userId): void
    {
        UserNotification::query()->create([
            'user_id' => $userId,
            'type' => 'push',
            'content' => 'User with id: ' . $userId . ', you have been blocked.'
        ]);
    }

    public function sendUnblockNotifications($userId): void
    {
        UserNotification::query()->create([
            'user_id' => $userId,
            'type' => 'push',
            'content' => 'User with id: ' . $userId . ', you have been unblocked.'
        ]);
    }

    /*
     * ifUserChangeQuery() частенько вижу этот метод в контроллерах, не могу понять его суть,
     * в принципе, если на него накинуть phpDoc, с кратким комментом, что, зачем и как, было бы классно
     *
     * UPD: Я так понял, через него мы смотрим, чтобы юзер трогал только свои фото/профиль и прочее,
     * но всю логику доступа нужно имплементировать на уровне policy
     */
    protected function ifUserChangeQuery($query): void
    {
        $user = User::query()->find($this->getUserID());
        if ($user->isUser()) {
            $query->where('user_id', $user->id);
        }
    }

    /*
     * Сильное дублирование кода, во всех контроллерах мелькает этот метод с одинаковой реализацией, я бы его
     * вынес в Trait, а то надо будет что-то в нем поменять, бегать потом по 30 контроллерам, такое себе)
     */
    protected function getUserID()
    {
        return Auth::user()->getAuthIdentifier();
    }
}
