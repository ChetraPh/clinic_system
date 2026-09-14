<?php

namespace App\Notifications;


use App\Models\Pharmacy\Medicine;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class LowStockNotification extends Notification
{
    use Queueable;

    protected Medicine $medicine;
    protected int $remaining;

    public function __construct(Medicine $medicine, int $remaining)
    {
        $this->medicine = $medicine;
        $this->remaining = $remaining;
    }

    public function via($notifiable): array
    {
        return ['database'];
    }

    public function toDatabase($notifiable): array
    {
        return [
            'type' => 'low_stock',
            'title' => 'Low Medicine Stock',
            'message' => "{$this->medicine->name} is low in stock ({$this->remaining} left)",
            'icon' => 'fa-pills',
            'color' => 'text-warning',
            // 'url' => route('pharmacy.details', $this->medicine->id),
              'url'     => route('medicines.show', $this->medicine->id),
        ];
    }
}
