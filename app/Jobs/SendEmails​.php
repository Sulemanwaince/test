<?php

namespace App\Jobs;

use App\Mail\RegisterUserMail;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;

class SendEmails​ implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */

     public function __construct(Post $post)
     {
         $this->post = $post;
     }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {


        $subscribers = User::all()->toArray();

        foreach ($subscribers as $subscriber)
        {
            \Mail::send('emails.blog', ['post' => $this->post, 'subscriber' => $subscriber], function ($m) use($subscriber) {
                $m->to($subscriber['email'], $subscriber['name']);
                $m->subject('A new article has been published.');
            });
        }
    }


}
