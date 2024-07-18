<?php

namespace App\Listeners;

use App\Models\Activity;
use App\Events\FollowUnfollowEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class FollowUnfollowListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(FollowUnfollowEvent $event)
    {
        Activity::create([
            'user_id' => $event->user->id,
            'target_user_id' => $event->targetUser->id,
            'type' => $event->type,
            'receiver_id' => $event->targetUser->id, // Set receiver_id
        ]);
    }
}
