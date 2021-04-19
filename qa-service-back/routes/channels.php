<?php

use App\Events\AcceptedEvent;
use App\Http\Controllers\QuestionController;
use App\Interfaces\QuestionServiceInterface;
use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('App.Models.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('channel-accepted.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('channel-pending.{id}', function ($user, $id) {
    return $user->hasRole('moderator');
});

Broadcast::channel('channel-denied.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

