<?php

namespace App\Console\Commands;

use App\Actions\SendWebsiteSubscriberEmailAction;
use Illuminate\Console\Command;

class SendWebsiteSubscriberEmailsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:website-subscriber-emails {postId}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send email notification to all website subscribers when a new post is published.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(SendWebsiteSubscriberEmailAction $action)
    {
        $this->info('Sending emails to subscribers...');

        $emailsSent = $action->execute($this->argument('postId'));

        $this->info("Emails Queued: {$emailsSent}");
        $this->info('************** Done ***************');

        return 1;
    }
}
