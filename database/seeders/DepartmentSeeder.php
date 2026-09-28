<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $departments = [
            ['department_id' => 1, 'department_name' => 'General / Administration'],
            ['department_id' => 2, 'department_name' => 'Cardiology'],
            ['department_id' => 9, 'department_name' => 'Pharmacy'],
        ];

        foreach ($departments as $dept) {
            DB::table('departments')->updateOrInsert(
                ['department_id' => $dept['department_id']],
                [
                    'department_name' => $dept['department_name'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }
    }
}