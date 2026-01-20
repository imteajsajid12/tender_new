<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CustomMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public $applicant_name, $app_id, $tender, $files;
    public function __construct($applicant_name,$app_id, $tender_id,$files)
    {
        $this->applicant_name = $applicant_name;
        $this->app_id = $app_id;
        $this->tender = $tender_id;
        $this->files = $files;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'כל הקבצים של '.$this->applicant_name.", מפניה מספר: ".$this->app_id." and מספר מכרז: ".$this->tender,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            htmlString: 'כל המסמכים של '.$this->applicant_name.", מפניה מספר: ".$this->app_id." ומכרז מספר: ".$this->tender.'. מצורפים המסמכים'
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [$this->files];
    }
}
