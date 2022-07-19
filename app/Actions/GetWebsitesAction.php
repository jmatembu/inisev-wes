<?php


namespace App\Actions;


use App\Http\Resources\WebsiteResource;
use App\Models\Website;
use Illuminate\Support\Facades\Cache;

class GetWebsitesAction
{
    /**
     * @return mixed
     */
    public function execute()
    {
        return Cache::remember('websites', now()->secondsUntilEndOfDay(), function () {
           return WebsiteResource::collection(Website::all());
        });
    }
}
