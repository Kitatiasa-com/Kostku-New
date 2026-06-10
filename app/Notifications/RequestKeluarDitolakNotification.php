<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use NotificationChannels\WebPush\WebPushMessage;
use NotificationChannels\WebPush\WebPushChannel;

class RequestKeluarDitolakNotification extends Notification
{
    public function __construct(public $penghuni) {}

    public function via($notifiable): array
    {
        return ['database', WebPushChannel::class];
    }

    public function toDatabase($notifiable): array
    {
        return [
            'judul' => 'Permintaan Keluar Ditolak',
            'pesan' => 'Permintaan keluar kost kamu telah ditolak. Alasan: ' . $this->penghuni->alasan_tolak_keluar,
            'url'   => route('dashboard.penghuni'),
            'icon'  => 'penghuni',
        ];
    }

    public function toWebPush($notifiable, $notification): WebPushMessage
    {
        return (new WebPushMessage)
            ->title('Permintaan Keluar Ditolak')
            ->body('Permintaan keluar kamu ditolak. Alasan: ' . $this->penghuni->alasan_tolak_keluar)
            ->action('Lihat', route('dashboard.penghuni'));
}
}