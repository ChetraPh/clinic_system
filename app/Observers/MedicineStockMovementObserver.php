<?php

namespace App\Observers;

use App\Models\Pharmacy\MedicineStockMovement;
use App\Notifications\LowStockNotification;
use App\Helpers\NotifiesRoles;
use Illuminate\Support\Facades\Notification;

class MedicineStockMovementObserver
{
    protected int $defaultLowStockThreshold = 10;

    public function created(MedicineStockMovement $movement): void
    {
        // Movement -> Batch -> Medicine
        $medicine = optional($movement->batch)->medicine;

        if (!$medicine) {
            return;
        }

        // Calculate current stock
        $remaining = $medicine->batches()
            ->sum('remaining_quantity');

        // Use medicine-specific reorder level
        // Otherwise use default threshold
        $threshold = $medicine->reorder_level
            ?? $this->defaultLowStockThreshold;

        if ($remaining <= $threshold) {

            $recipients = NotifiesRoles::usersForRoles([
                'admin',
                'pharmacist',
                'cashier',
            ]);

            if ($recipients->isNotEmpty()) {
                Notification::send(
                    $recipients,
                    new LowStockNotification(
                        $medicine,
                        $remaining
                    )
                );
            }
        }
    }
}
