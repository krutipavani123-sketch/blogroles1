<?php
// returns data from db and prepare to send mail
namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;
use App\Models\blog;
use App\Mail\exportmail;

class exporttask implements ShouldQueue
{
    use Queueable;
    public $email;
    /**
     * Create a new job instance.
     */
    public function __construct($email)
    {
        $this->email = $email;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        //$tasks = blog::all();
        $tasks = blog::where('id', 1)->get();


        Mail::to($this->email)->queue(new exportmail($tasks));
    }
}




//$tasks = blog::where('user_id', 1)->get();
