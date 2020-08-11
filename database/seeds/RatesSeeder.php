<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Models\Rate;

class RatesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if ($this->command->confirm('Do you want to seed rates table?')) {
            Model::unguard();

            if ($this->command->confirm('Do you want to clear rates table first?')) {
                DB::statement('SET FOREIGN_KEY_CHECKS=0;');
                DB::table('rates')->truncate();
                DB::statement('SET FOREIGN_KEY_CHECKS=1;');
            }

            Rate::create([
                'name'      => 'Базовый',
                'price'     => 1500,
                'default'   => true
            ]);

            $this->command->info('Rates table seeded!');

            Model::reguard();
        }
    }
}
