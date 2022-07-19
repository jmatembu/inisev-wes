<?php


namespace App\Actions;


use App\Models\Website;

class CreateWebsitePostAction
{
    /**
     * @param Website $website
     * @param array $details
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function execute(Website $website, array $details): \Illuminate\Database\Eloquent\Model
    {
        return $website->posts()->create($details);
    }
}
