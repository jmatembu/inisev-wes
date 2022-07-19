<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use App\Models\Website;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WebsiteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Website::factory(5)
            ->has(Post::factory()->count(10))
            ->has(User::factory()->count(5), 'subscribers')
            ->create();
    }
}
