<?php

namespace App\Mail\Front\Download\Support;

use App\Models\Download\DownloadSupport;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewTicketOutUser extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var DownloadSupport
     */
    public $support;

    /**
     * Create a new message instance.
     *
     * @param $support
     */
    public function __construct($support)
    {
        //
        $this->support = $support;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'))
            ->subject("Votre demande de support sur TF France")
            ->view('email.download.support.new_ticket_out_user');
    }
}
