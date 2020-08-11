<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Vendor;
use App\Events\VendorCreated;

class TestVendorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if ($this->command->confirm('Do you want to create test vendor?')) {
            Model::unguard();

            if ($this->command->confirm('Do you want to clear vendors table first?')) {
                DB::statement('SET FOREIGN_KEY_CHECKS=0;');
                DB::table('vendors')->truncate();
                DB::statement('SET FOREIGN_KEY_CHECKS=1;');
            }

            $vendor = Vendor::query()
                ->where('slug', 'test')
                ->first();
            if ($vendor === null) {
                $vendor = Vendor::create([
                    'name'   => 'Тестовая Компания',
                    'slug'   => 'test',
                    'active' => 1
                ]);
            }
            /** @var Vendor $vendor */

            $user = User::query()
                ->where('email', 'twoliquid@gmail.com')
                ->first();
            if ($user === null) {
                $user = User::create([
                    'name'       => 'Тестовый Пользователь',
                    'email'      => 'twoliquid@gmail.com',
                    'password'   => 'bananawanna',
                    'approved'   => false,
                    'email_confirmation_code' => str_random(16)
                ]);
            }

            $vendor->users()->detach($user->id);
            $vendor->users()->attach($user->id);

            event(new VendorCreated($vendor, $user));

            $this->command->info('Test vendor created!');

            Model::reguard();
        }
    }
}
