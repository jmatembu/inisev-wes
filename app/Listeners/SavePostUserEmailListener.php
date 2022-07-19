<?php

namespace App\Listeners;

use App\Actions\TrackPostUserEmailAction;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Events\MessageSent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Arr;

class SavePostUserEmailListener implements ShouldQueue
{
    protected TrackPostUserEmailAction $action;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(TrackPostUserEmailAction $action)
    {
        $this->action = $action;
    }

    /**
     * Handle the event.
     *
     * @param MessageSent $event
     * @return void
     */
    public function handle(MessageSent $event)
    {
        $this->action->execute(
            Arr::get($event->data, 'post'),
            $event->message->getTo()[0]->getAddress()
        );
    }

    /**
     * @param MessageSent $event
     * @return bool
     */
    public function shouldQueue(MessageSent $event): bool
    {
        return Arr::has($event->data, 'post');
    }

}
