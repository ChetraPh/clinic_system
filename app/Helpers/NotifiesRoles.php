<?php

namespace App\Helpers;

use App\Models\User;
use Illuminate\Support\Collection;

class NotifiesRoles
{
    /**
     * Get all users that have any of the given Spatie roles.
     * e.g. NotifiesRoles::usersForRoles(['admin', 'cashier'])
     */
    public static function usersForRoles(array $roles): Collection
    {
        return User::role($roles)->get();
    }

    /**
     * Shortcut for admins only.
     */
    public static function admins(): Collection
    {
        return static::usersForRoles(['admin']);
    }

    /**
     * Combine one specific user (e.g. the doctor assigned to an appointment)
     * with everyone who has the given roles (e.g. admin), removing duplicates.
     */
    public static function specificUserPlusRoles(?User $user, array $roles): Collection
    {
        $recipients = static::usersForRoles($roles);

        if ($user) {
            $recipients->push($user);
        }

        return $recipients->unique('id');
    }
}
