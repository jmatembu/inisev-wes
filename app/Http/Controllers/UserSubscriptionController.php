<?php

namespace App\Http\Controllers;

use App\Actions\SubscribeToWebsiteAction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserSubscriptionController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param SubscribeToWebsiteAction $action
     * @param User $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request, SubscribeToWebsiteAction $action, User $user)
    {
        $request->validate([
            'website_id' => 'required|exists:websites,id'
        ]);

        $action->execute($user, $request->website_id);

        return response()->json([], Response::HTTP_CREATED);
    }
}
