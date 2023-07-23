<?php

namespace App\Mail;

use App\Models\Questionnaire;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class QuestionnaireInvitation extends Mailable
{
    use Queueable, SerializesModels;

    public $questionnaire;
    public $url;
    public $token;

    /**
     * Create a new message instance.
     *
     * @param Questionnaire $questionnaire
     * @param $url
     * @param $token
     *
     * @return void
     */
    public function __construct(Questionnaire $questionnaire, $url, $token)
    {
        $this->questionnaire = $questionnaire;
        $this->url = $url;
        $this->token = $token;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Questionnaire Invitation : ' . $this->questionnaire->title,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.questionnaire_invitation',
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
