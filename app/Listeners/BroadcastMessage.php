<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\SendMessage;
use Laravel\Reverb\Events\MessageReceived;
class BroadcastMessage
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
    public function handle(object $event): void
    {
        //
        $message = json_decode($event->message);

        $data = $message->data;

        if ($message->event === 'SendMessage') {

            // your logic goes here...

            $data = json_decode($data);

            $data = $data->messageData;

            broadcast(new SendMessage($data))->toOthers();

        }
    }
}
