<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ResetPasswordEmail extends Mailable
{
    use Queueable, SerializesModels;

    private $user;
    private $token;

    /**
     * Create a new message instance.
     * @param User $user
     * @param $token
     */
    public function __construct(User $user, string $token)
    {
        //
        $this->user = $user;
        $this->token = $token;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Reset Password Email',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.reset-password-email',
             with: [
        'user' => $this->user->name,
        'link' => $this->generateLink(),
          ],
        );
    }

    protected function generateLink()
    {
        return route('auth.password.reset.form',['token' => $this->token,'email' => $this->user->email]);
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
