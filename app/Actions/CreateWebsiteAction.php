<?php


namespace App\Actions;


use App\Models\Website;
use Illuminate\Support\Facades\Cache;

class CreateWebsiteAction
{
    /**
     * @param array $details
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function execute(array $details): \Illuminate\Database\Eloquent\Model
    {
        $website = Website::create($details);

        /**
         * Let's forget the cached websites data so that the newly created website
         * will show up when listing all websites
         */
        Cache::forget('websites');

        return $website;
    }
}
