<?php

namespace App\Notifications;

use App\Models\LabOrder;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class LabResultNotification extends Notification
{
    use Queueable;

    protected LabOrder $labOrder;

    public function __construct(LabOrder $labOrder)
    {
        $this->labOrder = $labOrder;
    }

    public function via($notifiable): array
    {
        return ['database'];
    }

    public function toDatabase($notifiable): array
    {
        // LabOrder -> MedicalRecord -> Patient (adjust if your relation names differ)
        $patientName = optional(optional($this->labOrder->medicalRecord)->patient)->full_name ?? 'a patient';

        return [
            'type' => 'lab_result',
            'title' => 'Lab Result Ready',
            'message' => "Lab results for {$patientName} are ready for review",
            'icon' => 'fa-flask',
            'color' => 'text-info',
            // No order-level detail page exists yet, so this links to the lab list
            'url' => route('lab.index'),
        ];
    }
}
