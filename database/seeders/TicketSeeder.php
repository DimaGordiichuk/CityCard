<?php

namespace Database\Seeders;

use App\Models\Card;
use App\Models\User;
use App\Models\Transport;
use Illuminate\Database\Seeder;

class TicketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('tickets')->delete();

        \DB::table('tickets')->insert([
            [
                'price' => '8.00',
                'user_id' => User::all()->random()->id,
                'card_id' => Card::all()->random()->id,
                'transport_id' => Transport::all()->random()->id,
                'created_at' => new \DateTime(),
                'updated_at' => new \DateTime(),
            ], [
                'price' => '8.00',
                'user_id' => User::all()->random()->id,
                'card_id' => Card::all()->random()->id,
                'transport_id' => Transport::all()->random()->id,
                'created_at' => new \DateTime(),
                'updated_at' => new \DateTime(),
            ], [
                'price' => '8.00',
                'user_id' => User::all()->random()->id,
                'card_id' => Card::all()->random()->id,
                'transport_id' => Transport::all()->random()->id,
                'created_at' => new \DateTime(),
                'updated_at' => new \DateTime(),
            ],
        ]);

        $this->command->info('Tickets seed success!');
    }
}
