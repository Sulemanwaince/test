<?php

namespace App\Jobs;

use App\Http\Controllers\ImportExcelController;
use App\Mail\RegisterUserMail;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;

class NewUserRegisterEmail implements ShouldQueue
{
    //traits hain ye char
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public  $user = null;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($user)
    {
        $this->user = $user;
        //

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        Mail::to($this->user)->send(new RegisterUserMail());

        //
    }
}
