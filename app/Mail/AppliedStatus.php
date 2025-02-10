<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AppliedStatus extends Mailable
{
    use Queueable, SerializesModels;
    public $subject;
    public $details;

    public $company_email;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($details)
    {
        // dd($details);
        $this->details = $details;
        $this->company_email = $details['company_email'];

        if($details['status'] == 1)
        {
            $this->subject = 'You Have Been Accepted';
        }else{
            $this->subject = 'You Have Been Declined';
        }
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            from:$this->company_email,
            subject: $this->subject,
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            markdown: 'emails.AppliedStatus',
            with: [
                'details' => $this->details,
            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
