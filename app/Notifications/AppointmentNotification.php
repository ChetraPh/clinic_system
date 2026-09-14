<?php

namespace App\Notifications;

use App\Models\Appointment;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class AppointmentNotification extends Notification
{
    use Queueable;

    protected Appointment $appointment;
    protected string $action; // 'created' | 'updated' | 'cancelled'

    public function __construct(Appointment $appointment, string $action = 'created')
    {
        $this->appointment = $appointment;
        $this->action = $action;
    }

    public function via($notifiable): array
    {
        return ['database'];
    }

    public function toDatabase($notifiable): array
    {
        $patientName = optional($this->appointment->patient)->full_name ?? 'a patient';

        $messages = [
            'created'   => "New appointment booked with {$patientName}",
            'updated'   => "Appointment with {$patientName} was updated",
            'cancelled' => "Appointment with {$patientName} was cancelled",
        ];

        return [
            'type'    => 'appointment',
            'title'   => 'Appointment ' . ucfirst($this->action),
            'message' => $messages[$this->action] ?? $messages['created'],
            'icon'    => 'fa-calendar-check',
            'color'   => $this->action === 'cancelled' ? 'text-danger' : 'text-primary',
            'url'     => route('appointment.show', $this->appointment->appointment_id),
        ];
    }
}
