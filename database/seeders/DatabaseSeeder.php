<?php

namespace Database\Seeders;

use App\Models\Appointment;
use App\Models\Client;
use App\Models\Event;
use App\Models\Project;
use App\Models\ProjectAssignee;
use App\Models\ProjectCategory;
use App\Models\ProjectNote;
use App\Models\Report;
use App\Models\Status;
use App\Models\Task;
use App\Models\TaskAssignee;
use App\Models\TaskCategory;
use App\Models\TaskNote;
use App\Models\Transaction;
use App\Models\TransactionType;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Database\Factories\AssigneeFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        User::factory()->create([
            'name' => 'Zoe',
            'email' => 'zoe@example.com',
            'password' => bcrypt('password'),
        ]);

        Client::factory(5)->create();
        Project::factory(5)->create();
        ProjectAssignee::factory(5)->create();
        ProjectCategory::factory(5)->create();
        ProjectNote::factory(5)->create();
        Task::factory(5)->create();
        TaskCategory::factory(5)->create();
        TaskNote::factory(5)->create();
        TaskAssignee::factory(5)->create();
        Appointment::factory(5)->create();
        TransactionType::factory(5)->create();
        Transaction::factory(5)->create();
        

    }
}
