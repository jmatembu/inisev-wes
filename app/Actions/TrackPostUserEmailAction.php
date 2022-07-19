<?php


namespace App\Actions;


use App\Models\Post;
use App\Models\User;

class TrackPostUserEmailAction
{
    /**
     * Track all the users that have been sent a particular post. This way, we can avoid sending
     * the same post to a user for example when running the send:website-subscriber-emails
     * more than once or when retrying failed jobs in the queue.
     *
     * @param Post $post
     * @param string $email
     * @return bool
     */
    public function execute(Post $post, string $email): bool
    {
        $user = User::where('email', $email)->first();

        if (empty($user)) {
            return false;
        }

        $user->postEmails()->syncWithoutDetaching([$post->id]);

        return true;
    }
}
