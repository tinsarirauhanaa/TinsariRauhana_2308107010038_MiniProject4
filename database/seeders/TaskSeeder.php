<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Task; 
use App\Models\User; 
class TaskSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil user pertama
        $user = User::first();
        
        if (!$user) {
            throw new \Exception('No user found. Please seed the users table first.');
        }

        Task::create([
            'user_id' => $user->id,
            'title' => 'Demo Sprint 2 RPL',
            'description' => 'Selesaikan mendix',
            'date' => '2025-05-30',
            'time' => '13:00:00',
            'color' => 'pink',
        ]);

        Task::create([
            'user_id' => $user->id,
            'title' => 'Belajar PBW',
            'description' => 'Deadline mini-project-4',
            'date' => '2025-05-30',
            'time' => '17:00:00',
            'color' => 'pink',
        ]);
    }
}