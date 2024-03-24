<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NewSellProposal extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    public $labels = [
        'Brand',
        'Model',
        'Reference',
        'Movement',
        'Case material',
        'Strap/bracelet material',
        'Original strap/bracelet',
        'Original bracelet buckle/clasp',
        'Year of the watch',
        'State of wear of the watch',
        'Do you still have the original watch box?',
        'Do you still have the original watch warranty?'
    ];

    /**
     * Create a new message instance.
     */
    public function __construct($_data)
    {
        $this->data = $_data;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'New watch sales proposal',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.sell-proposal',
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
