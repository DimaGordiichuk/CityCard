<?php

namespace Database\Seeders;

use App\Models\Card;
use Illuminate\Database\Seeder;

class CardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('cards')->delete();

        \DB::table('cards')->insert([
            [
                'type' => Card::TYPE_CONCESSION,
                'user_id' => 1,
                'created_at' => new \DateTime(),
                'updated_at' => new \DateTime(),
            ],
            [
                'type' => Card::TYPE_TYPICAL,
                'user_id' => 1,
                'created_at' => new \DateTime(),
                'updated_at' => new \DateTime(),
            ],
            [
                'type' => Card::TYPE_CONCESSION,
                'user_id' => 2,
                'created_at' => new \DateTime(),
                'updated_at' => new \DateTime(),
            ],
            [
                'type' => Card::TYPE_TYPICAL,
                'user_id' => 3,
                'created_at' => new \DateTime(),
                'updated_at' => new \DateTime(),
            ],
        ]);

        $this->command->info('Cards seed success!');
    }
}
