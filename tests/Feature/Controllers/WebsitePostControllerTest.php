<?php

namespace Tests\Feature\Controllers;

use App\Events\PostCreated;
use App\Models\Website;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class WebsitePostControllerTest extends TestCase
{
    use RefreshDatabase;

    protected $website;

    public function setUp(): void
    {
        parent::setUp();
        $this->website = Website::factory()->create();
    }

    public function test_can_create_post_for_website()
    {
        Event::fake();
        $postDetails = [
            'title' => 'Welcome to the Inisev blog!',
            'description' => 'This blog will update you on company level news. For product-specific updates, please visit the blogs of the respective services'
        ];

        $this->post(route('api.websites.posts.store', $this->website), $postDetails)
            ->assertStatus(Response::HTTP_CREATED)
            ->assertJsonFragment($postDetails);

        Event::assertDispatched(PostCreated::class);
    }

    public function test_cannot_create_post_without_title()
    {
        $postDetails = [
            'description' => 'This blog will update you on company level news. For product-specific updates, please visit the blogs of the respective services'
        ];

        $this->post(route('api.websites.posts.store', $this->website), $postDetails)
            ->assertSessionHasErrors();

        $this->assertDatabaseMissing('posts', $postDetails);
    }

    // TODO: Test that user cannot create post without a description
}
