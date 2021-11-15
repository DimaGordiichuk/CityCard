<?php

namespace Database\Seeders;

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
        $this->call(TransportSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(CardSeeder::class);
        $this->call(TicketSeeder::class);
    }
}
