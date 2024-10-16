<?php

namespace App\Listeners;

use App\Events\Contact;
use App\Mail\SendContact;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendContactListen implements ShouldQueue
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
     * @param  \App\Events\Contact  $event
     * @return void
     */
    public function handle(Contact $event)
    {
        $users = User::all();

        foreach ($users as $key => $itemUser) {
            $email = new SendContact($event->name);

            $when = now()->addSeconds($key * 5);

            Mail::to($itemUser)->later($when, $email);
        }
    }
}
