<?php

namespace App\Listeners;

use App\Console\Commands\SendWebsiteSubscriberEmailsCommand;
use App\Events\PostCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Artisan;

class NotifyPostWebsiteSubscriberListener implements ShouldQueue
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
     * @param PostCreated $event
     * @return void
     */
    public function handle(PostCreated $event)
    {
        Artisan::call(
            SendWebsiteSubscriberEmailsCommand::class,
            ['postId' => $event->post->id]
        );
    }
}
