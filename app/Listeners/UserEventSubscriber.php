<?php

namespace App\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserEventSubscriber
{
    /**
     * Register the listeners for the subscriber.
     *
     * @param  Illuminate\Events\Dispatcher  $events
     */
    public function subscribe($events)
    {
        $events->listen(
            'Illuminate\Auth\Events\Login',
            'App\Listeners\UserEventSubscriber@onUserLogin'
        );
    }

    public function onUserLogin($event)
    {
        $tokenAccess = bcrypt(date('YmdHms'));
        
        $user = auth()->user();
        $user->token_access = $tokenAccess;
        $user->save();

        session()->put('access_token', $tokenAccess);
    }
}
