<?php

namespace App\Observers;

use App\Models\Appointment;
use App\Notifications\AppointmentNotification;
use App\Helpers\NotifiesRoles;
use Illuminate\Support\Facades\Notification;

class AppointmentObserver
{
    public function created(Appointment $appointment): void
    {
        $this->notify($appointment, 'created');
    }

    public function updated(Appointment $appointment): void
    {
        if ($appointment->wasChanged('status') && $appointment->status === 'cancelled') {
            $this->notify($appointment, 'cancelled');
            return;
        }

        if ($appointment->wasChanged(['appointment_date', 'appointment_time', 'status'])) {
            $this->notify($appointment, 'updated');
        }
    }

    protected function notify(Appointment $appointment, string $action): void
    {
        // Adjust ->doctor->user if your Appointment model names the relation differently.
        // This assumes: appointment->doctor is an user, and user->user is the login account.
        $doctorUser = optional($appointment->doctor)->user;

        // Doctor assigned to THIS appointment + everyone with the admin role
        $recipients = NotifiesRoles::specificUserPlusRoles($doctorUser, ['admin']);

        if ($recipients->isNotEmpty()) {
            Notification::send($recipients, new AppointmentNotification($appointment, $action));
        }
    }
}
