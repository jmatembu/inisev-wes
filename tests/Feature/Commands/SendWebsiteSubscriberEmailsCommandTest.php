<?php

namespace Tests\Feature\Commands;

use App\Actions\SendWebsiteSubscriberEmailAction;
use App\Mail\PostCreated;
use App\Models\Post;
use App\Models\User;
use App\Models\Website;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Mockery\MockInterface;
use Tests\TestCase;

class SendWebsiteSubscriberEmailsCommandTest extends TestCase
{
    use RefreshDatabase;

    /**
     * The command should queue emails to all
     */
    public function test_runs_action_to_send_website_subscriber_emails()
    {
        Mail::fake();

        $website = Website::factory()
            ->has(User::factory()->count(5), 'subscribers')
            ->create();
        $post = Post::factory()->for($website)->create();

        $this->artisan('send:website-subscriber-emails', ['postId' => $post->id])
            ->assertExitCode(1)
            ->expectsOutputToContain('Emails Queued: 5');

        Mail::assertQueued(PostCreated::class);
    }

    public function test_doesnt_send_website_subscriber_emails_twice()
    {
        Mail::fake();
        $website = Website::factory()
            ->has(User::factory()->count(5), 'subscribers')
            ->create();
        $post = Post::factory()->for($website)->create();
        $post->userEmails()->attach($website->subscribers->pluck('id')->all());

        $this->artisan('send:website-subscriber-emails', ['postId' => $post->id])
            ->assertExitCode(1)
            ->expectsOutputToContain('Emails Queued: 0');
    }
}
