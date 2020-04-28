<?php

use App\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'      =>  'Admin',
            'email'     =>  'admin@example.test',
            'password'  =>  '$2y$10$jFqMRBg32skige9wLRtfLOh2XsREZMpqgRnXGKUHrNR/NKnD8mFPm'
        ]);
    }
}
