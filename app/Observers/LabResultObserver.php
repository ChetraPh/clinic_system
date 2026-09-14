<?php

namespace App\Observers;

use App\Models\LabResult;
use App\Notifications\LabResultNotification;
use App\Helpers\NotifiesRoles;
use Illuminate\Support\Facades\Notification;

class LabResultObserver
{
    public function created(LabResult $labResult): void
    {
        // Adjust relation chain to match your schema: LabResult -> LabOrder -> doctor -> user
        $doctorUser = optional(optional($labResult->labOrder)->doctor)->user;

        // Ordering doctor + admins + nurses (nurses often relay results to the doctor/patient)
        $recipients = NotifiesRoles::specificUserPlusRoles($doctorUser, ['admin', 'nurse']);

        if ($recipients->isNotEmpty()) {
            Notification::send($recipients, new LabResultNotification($labResult));
        }
    }
}
