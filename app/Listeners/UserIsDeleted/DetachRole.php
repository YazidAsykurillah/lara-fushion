<?php

namespace App\Listeners\UserIsDeleted;

use App\Events\UserIsDeleted;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class DetachRole
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  UserIsDeleted  $event
     * @return void
     */
    public function handle(UserIsDeleted $event)
    {
        $user = $event->user;
        \DB::table('role_user')->where('user_id', '=', $user->id)->delete();
    }
}
