<?php


namespace App\Actions;


use App\Models\User;

class SubscribeToWebsiteAction
{
    /**
     * @param User $user
     * @param int $websiteId
     * @return array
     */
    public function execute(User $user, int $websiteId): array
    {
        return $user->subscriptions()->syncWithoutDetaching([$websiteId]);
    }
}
