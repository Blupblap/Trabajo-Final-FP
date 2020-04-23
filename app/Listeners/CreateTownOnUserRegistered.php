<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Registered;

class CreateTownOnUserRegistered
{
    public function handle(Registered $event)
    {
        $event->user->town()->create();
    }
}
