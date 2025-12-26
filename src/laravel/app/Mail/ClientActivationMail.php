<?php

namespace App\Mail;

use App\Models\Client;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ClientActivationMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $client;
    public $activationUrl;

    /**
     * Create a new message instance.
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
        
        // Генерируем URL для активации
        // Используем метод getActivationUrl() из модели или генерируем здесь
        $this->activationUrl = url('/activate/' . $client->email_verification_token);
        
        // Альтернативно, если в модели есть метод:
        // $this->activationUrl = $client->getActivationUrl();
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Активация вашего аккаунта в системе бронирования',
            from: [
                'address' => config('mail.from.address'),
                'name' => config('mail.from.name') ?? config('app.name'),
            ],
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.client_activation',
            with: [
                'client' => $this->client,
                'activationUrl' => $this->activationUrl,
                'appName' => config('app.name', 'Система бронирования'),
                'currentYear' => date('Y'),
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