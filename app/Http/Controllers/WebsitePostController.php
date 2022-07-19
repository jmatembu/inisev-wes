<?php

namespace App\Http\Controllers;

use App\Actions\CreateWebsitePostAction;
use App\Http\Requests\StorePostRequest;
use App\Http\Resources\PostResource;
use App\Models\Website;

class WebsitePostController extends Controller
{
    /**
     * Store a newly created post for the specified website
     *
     * @param \App\Http\Requests\StorePostRequest $request
     * @param CreateWebsitePostAction $action
     * @param Website $website
     * @return PostResource
     */
    public function store(StorePostRequest $request, CreateWebsitePostAction $action, Website $website): PostResource
    {
        return new PostResource(
            $action->execute($website, $request->validated())
        );
    }
}
