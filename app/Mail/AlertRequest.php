<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;
use App\Models\Location;

class AlertRequest extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $requests_model;
    public $requests_from;
    public $requests_to;
    public $requests_date;
    public $requests_type;
    public $requests_comment;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, $requests_type, $requests_id, $requests_from, $requests_to, $requests_date, $requests_comment)
    {
        $this->user = $user;
        $this->requests_type = $comment;
        $m = "\\App\\Models\\".ucfirst($type);
        $this->requests_model = $m::find($id);
        $this->requests_from = Location::find($from);
        $this->requests_to = Location::find($to);
        $this->requests_date = $date;
        $this->requests_comment = $comment;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('admin.user.alert-request');
    }
}
