<?php

namespace App\Notifications;

use App\Models\InvoicePayment;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class PaymentNotification extends Notification
{
    use Queueable;

    protected InvoicePayment $payment;

    public function __construct(InvoicePayment $payment)
    {
        $this->payment = $payment;
    }

    public function via($notifiable): array
    {
        return ['database'];
    }

    public function toDatabase($notifiable): array
    {
        $amount = number_format($this->payment->amount, 2);

        // Invoice stores patient_name directly, no separate patient relation needed here
        $patientName = optional($this->payment->invoice)->patient_name ?? 'a patient';

        return [
            'type'    => 'payment',
            'title'   => 'New Payment Received',
            'message' => "A payment of \${$amount} was recorded for {$patientName}",
            'icon'    => 'fa-money-bill-wave',
            'color'   => 'text-success',
            // Payments are viewed through their invoice, not their own page
            'url'     => route('billing.show', $this->payment->invoice_id),
        ];
    }
}
