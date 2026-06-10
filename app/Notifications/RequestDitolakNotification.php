<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use NotificationChannels\WebPush\WebPushMessage;
use NotificationChannels\WebPush\WebPushChannel;

class RequestDitolakNotification extends Notification
{
    public function __construct(public $penghuni) {}

    public function via($notifiable): array
    {
        return ['database', WebPushChannel::class];
    }

    public function toDatabase($notifiable): array
    {
        return [
            'judul' => 'Request Kost Ditolak',
            'pesan' => 'Maaf! Permintaan bergabung kost kamu telah ditolak. Alasan: ' . $this->penghuni->alasan_tolak,
            'url'   => route('dashboard.penghuni'),
            'icon'  => 'penghuni',
        ];
    }

    public function toWebPush($notifiable, $notification): WebPushMessage
    {
        return (new WebPushMessage)
            ->title('Request Kost Ditolak')
            ->body('Permintaan kamu ditolak. Alasan: ' . $this->penghuni->alasan_tolak)
            ->action('Lihat', route('dashboard.penghuni'));
    }
}