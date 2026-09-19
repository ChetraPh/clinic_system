<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        $usersData = [
            [
                'name' => 'Super Admin',
                'username' => 'superadmin',
                'email' => 'superAdmin@gmail.com',
                'password' => 'admin123',
                'role' => 'admin',
                'department_id' => 1,
            ],
            [
                'name' => 'Doctor User',
                'username' => 'doctor',
                'email' => 'doctor@gmail.com',
                'password' => 'doctor123',
                'role' => 'doctor',
                'department_id' => 2,
            ],
            [
                'name' => 'Nurse User',
                'username' => 'nurse',
                'email' => 'nurse@gmail.com',
                'password' => 'nurse123',
                'role' => 'nurse',
                'department_id' => 1,
            ],
            [
                'name' => 'Pharmacist User',
                'username' => 'pharmacist',
                'email' => 'pharmacist@gmail.com',
                'password' => 'pharmacist123',
                'role' => 'pharmacist',
                'department_id' => 9,
            ],
            [
                'name' => 'Cashier User',
                'username' => 'cashier',
                'email' => 'cashier@gmail.com',
                'password' => 'cashier123',
                'role' => 'cashier',
                'department_id' => 1,
            ],
        ];

        foreach ($usersData as $data) {
            $user = User::updateOrCreate(
                [
                    'email' => $data['email'],
                ],
                [
                    'name' => $data['name'],
                    'username' => $data['username'],
                    'password' => Hash::make($data['password']),
                    'department_id' => $data['department_id'],
                ]
            );

            if (method_exists($user, 'syncRoles')) {
                $user->syncRoles([$data['role']]);
            }
        }
    }
}
