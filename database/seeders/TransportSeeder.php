<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TransportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('transports')->delete();

        \DB::table('transports')->insert([
            [
                'name' => 'Автобус',
                'number' => '22',
                'price' => 8.00,
                'created_at' => new \DateTime(),
                'updated_at' => new \DateTime(),
            ],
            [
                'name' => 'Тролейбус',
                'number' => '12',
                'price' => 4.00,
                'created_at' => new \DateTime(),
                'updated_at' => new \DateTime(),
            ],

        ]);
        $this->command->info('Transport seed success!');
    }
}
