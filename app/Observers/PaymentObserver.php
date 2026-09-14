<?php

namespace App\Observers;

use App\Models\Payment;
use App\Notifications\PaymentNotification;
use App\Helpers\NotifiesRoles;
use Illuminate\Support\Facades\Notification;

class PaymentObserver
{
    public function created(Payment $payment): void
    {
        $recipients = NotifiesRoles::usersForRoles(['admin', 'cashier']);

        if ($recipients->isNotEmpty()) {
            Notification::send($recipients, new PaymentNotification($payment));
        }
    }
}
