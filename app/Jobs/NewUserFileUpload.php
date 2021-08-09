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

class NewUserFileUpload implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public  $path= null;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($path)
    {

        $this->path = $path;
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $obj = new ImportExcelController();
        $obj->importBackground($this->path);
        //
    }
}
