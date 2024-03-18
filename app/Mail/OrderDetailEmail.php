<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OrderDetailEmail extends Mailable
{
    use Queueable, SerializesModels;
    public $order;
    public $user;

    /**
     * Create a new message instance.
     * @param $order
     */
    public function __construct(Order $order)
    {
        //
        $this->order = $order;
        $this->user = $order->user;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: " جزئیات سفارش $this->order->id",with: [
                'order' => $this->order,
                'user' => $this->user->name,
            ],
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.order-detail-email',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [
            Attachment::fromStorage('public')->as('invoices/'.$this->order->id)->withMime('application/pdf'),
        ];
    }
}
