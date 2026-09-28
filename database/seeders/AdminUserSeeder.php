<?php

namespace Database\Seeders;
<<<<<<< HEAD

=======
>>>>>>> 50a841fed0665507ef91532f088778c6c8d1d66d
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
            ],
            [
                'name' => 'Doctor User',
                'username' => 'doctor',
                'email' => 'doctor@gmail.com',
                'password' => 'doctor123',
                'role' => 'doctor',
            ],
            [
                'name' => 'Nurse User',
                'username' => 'nurse',
                'email' => 'nurse@gmail.com',
                'password' => 'nurse123',
                'role' => 'nurse',
            ],
            [
                'name' => 'Pharmacist User',
                'username' => 'pharmacist',
                'email' => 'pharmacist@gmail.com',
                'password' => 'pharmacist123',
                'role' => 'pharmacist',
            ],
            [
                'name' => 'Cashier User',
                'username' => 'cashier',
                'email' => 'cashier@gmail.com',
                'password' => 'cashier123',
                'role' => 'cashier',
            ],
        ];

        foreach ($usersData as $data) {
            $user = User::updateOrCreate(
                [
                    'email' => $data['email'],
                ],
                [
                    'name' => $data['name'],
                    'username' => $data['username'] ?? null,
                    'password' => Hash::make($data['password']),
                    'department_id' => $data['department_id'],
                ]
            );

<<<<<<< HEAD
            // បើ project របស់អ្នកមានប្រើ Spatie Permission សម្រាប់ Assign Role
=======
>>>>>>> 50a841fed0665507ef91532f088778c6c8d1d66d
            if (method_exists($user, 'syncRoles')) {
                $user->syncRoles([$data['role']]);
            }
        }
    }
}