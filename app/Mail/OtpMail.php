<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

/**
 * OTP Email Mailable
 *
 * A reusable mailable class for sending OTP verification codes.
 * Supports customizable templates and multiple purposes.
 */
class OtpMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The OTP code to send
     */
    public string $otpCode;

    /**
     * The purpose of the OTP
     */
    public string $purpose;

    /**
     * How long until the OTP expires
     */
    public int $expiryMinutes;

    /**
     * Email subject line
     */
    protected string $emailSubject;

    /**
     * Blade template to use
     */
    public string $template;

    /**
     * The user receiving the OTP
     */
    public ?User $user;

    /**
     * Create a new message instance.
     */
    public function __construct(
        string $otpCode,
        string $purpose,
        int $expiryMinutes,
        string $subject,
        string $template = 'emails.otp',
        ?User $user = null
    ) {
        $this->otpCode = $otpCode;
        $this->purpose = $purpose;
        $this->expiryMinutes = $expiryMinutes;
        $this->emailSubject = $subject;
        $this->template = $template;
        $this->user = $user;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->emailSubject,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: $this->template,
            with: [
                'otpCode' => $this->otpCode,
                'purpose' => $this->purpose,
                'expiryMinutes' => $this->expiryMinutes,
                'user' => $this->user,
                'appName' => config('app.name'),
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
