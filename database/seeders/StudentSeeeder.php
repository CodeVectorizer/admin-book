<?php

namespace Database\Seeders;

use App\Models\Student;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class StudentSeeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => ' User Student',
            'email' => 'student@user.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'role' => 'student'
        ]);

        Student::create([
            'user_id' => $user->id,
            'nik' => '12312312323',
            'class' => '6',
            'major' => '2020',
            'address' => 'Jember'
        ]);
    }
}
