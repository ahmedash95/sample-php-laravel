<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\JobApplication;

class JobApplied extends Mailable
{
    use Queueable, SerializesModels;

    public $company;
    public $candidate;
    public $job_application;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(JobApplication $job_application)
    {
        $this->company = $job_application->job->user;
        $this->candidate = $job_application->user;
        $this->job_application = $job_application;
        $this->subject('Job application received at '.config('app.name'));
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.jobs.applied');
    }
}
