<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Website;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\TestCase;

class UserSubscriptionControllerTest extends TestCase
{
    use RefreshDatabase;

    protected $website;

    public function setUp(): void
    {
        parent::setUp();
        $this->website = Website::factory()->create();
    }

    public function test_can_subscribe_user_to_website()
    {
        $user = User::factory()->create();

        $this->post(
            route('api.users.subscriptions.store', $user),
            ['website_id' => $this->website->id]
        )
            ->assertStatus(Response::HTTP_CREATED)
            ->assertExactJson([]);
    }

    public function test_can_only_subscribe_user_to_existing_website()
    {
        $user = User::factory()->create();

        $this->post(
            route('api.users.subscriptions.store', $user),
            ['website_id' => 99999]
        )
            ->assertSessionHasErrors();

        $this->assertDatabaseMissing('user_website', [
            'user_id' => $user->id,
            'website_id' => 99999
        ]);

    }
}
