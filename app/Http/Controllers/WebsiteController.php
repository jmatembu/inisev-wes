<?php

namespace App\Http\Controllers;

use App\Actions\CreateWebsiteAction;
use App\Actions\GetWebsitesAction;
use App\Http\Requests\StoreWebsiteRequest;
use App\Http\Resources\WebsiteResource;
use App\Models\Website;

class WebsiteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(GetWebsitesAction $action)
    {
        return $action->execute();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreWebsiteRequest $request
     * @param CreateWebsiteAction $action
     * @return WebsiteResource
     */
    public function store(StoreWebsiteRequest $request, CreateWebsiteAction $action)
    {
        return new WebsiteResource($action->execute($request->validated()));
    }

    /**
     * Display the specified resource.
     *
     * @param Website $website
     * @return WebsiteResource
     */
    public function show(Website $website)
    {
        return new WebsiteResource($website->load(['subscribers', 'posts']));
    }
}
