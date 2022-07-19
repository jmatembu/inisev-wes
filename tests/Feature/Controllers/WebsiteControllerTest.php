<?php

namespace Tests\Feature\Controllers;

use App\Models\Website;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\TestCase;

class WebsiteControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list_websites()
    {
        $websites = Website::factory(5)->create();

        $this->get(route('api.websites.index'))
            ->assertOk()
            ->assertJsonCount(5, 'data')
            ->assertJson(['data' => $websites->toArray()]);
    }

    public function test_can_show_website_details()
    {
        $website = Website::factory()->create();

        $this->get(route('api.websites.show', $website))
            ->assertOk()
            ->assertJsonFragment($website->load(['subscribers', 'posts'])->toArray());
    }

    public function test_can_create_website()
    {
        $websiteDetails = [
            'name' => 'Inisev',
            'url' => 'https://inisev.com',
            'description' => 'Use our products for free'
        ];

        $this->post(route('api.websites.store'), $websiteDetails)
            ->assertStatus(Response::HTTP_CREATED)
            ->assertJsonFragment($websiteDetails);
    }
}
