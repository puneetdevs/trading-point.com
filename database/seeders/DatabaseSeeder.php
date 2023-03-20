<?php

namespace Database\Seeders;

use App\Models\FormSubmission;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            CompaniesTableSeeder::class,
        ]);

        $this->command->info('Seeding Done');
        $this->command->info('_____________________');
    }
}
