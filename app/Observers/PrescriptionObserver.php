<?php

namespace App\Observers;

use App\Models\Prescription;
use App\Notifications\PrescriptionNotification;
use App\Helpers\NotifiesRoles;
use Illuminate\Support\Facades\Notification;

class PrescriptionObserver
{
    public function created(Prescription $prescription): void
    {
        $recipients = NotifiesRoles::usersForRoles(['admin', 'nurse', 'pharmacist']);

        if ($recipients->isNotEmpty()) {
            Notification::send($recipients, new PrescriptionNotification($prescription));
        }
    }
}
