<?php


namespace App\Actions;


use App\Mail\PostCreated;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class SendWebsiteSubscriberEmailAction
{
    /**
     * Number of emails that will be queued
     * @var int
     */
    protected int $emailsQueued = 0;

    /**
     * @param int $postId
     * @return int
     */
    public function execute(int $postId): int
    {
        $post = Post::findOrFail($postId);

        /**
         * Let's loop through all the subscribers of the website on which the post
         * was published. If we find that the post was already sent to the
         * subscriber, we just skip.
         */
        $post->website->subscribers->each(function (User $user) use ($post) {

            if ($this->postEmailedToUser($user, $post)) {
                return true;
            }

            Mail::to($user)->send(new PostCreated($post));

            $this->emailsQueued++;

            return true;
        });


        return $this->emailsQueued;
    }

    /**
     * Check if the post has already been emailed to the user
     *
     * @param User $user
     * @param Post $post
     * @return bool
     */
    protected function postEmailedToUser(User $user, Post $post): bool
    {
        $emailedPost = $user->postEmails->firstWhere(function ($emailedPost) use ($post) {
            return $post->id === $emailedPost->id;
        });

        return !empty($emailedPost);
    }
}
