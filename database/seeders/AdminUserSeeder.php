<?php

namespace Database\Seeders;

use App\Models\user;
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
                'email' => 'supperAdmin@gmai.com',
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

            /*
            |--------------------------------------------------------------------------
            | Create / Update User
            |--------------------------------------------------------------------------
            */

            $user = User::updateOrCreate(
                [
                    'email' => $data['email'],
                ],
                [
                    'name' => $data['name'],
                    'username' => $data['username'],
                    'password' => Hash::make($data['password']),
                ]
            );

            /*
            |--------------------------------------------------------------------------
            | Assign Role
            |--------------------------------------------------------------------------
            */

            $user->syncRoles([$data['role']]);

            /*
            |--------------------------------------------------------------------------
            | Create user
            |--------------------------------------------------------------------------
            |
            | Cashier is skipped because the current users.role ENUM
            | does not contain "cashier".
            |
            */

            if (
                in_array($data['role'], [
                    'admin',
                    'doctor',
                    'nurse',
                    'pharmacist',
                ])
            ) {

                $nameParts = explode(
                    ' ',
                    trim($data['name']),
                    2
                );

                user::updateOrCreate(
                    [
                        'user_id' => $user->id,
                    ],
                    [
                        'department_id' => $data['department_id'],

                        'user_code' =>
                            'EMP-' .
                            str_pad(
                                $user->id,
                                3,
                                '0',
                                STR_PAD_LEFT
                            ),

                        'first_name' => $nameParts[0],

                        'last_name' =>
                            $nameParts[1] ?? '',

                        'role' => $data['role'],

                        'specialization' => null,

                        'phone' => null,

                        'status' => 'active',
                    ]
                );
            }
        }
    }
}