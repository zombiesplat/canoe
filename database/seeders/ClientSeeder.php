<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\Fund;
use Illuminate\Database\Seeder;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Client::factory()
            ->state([
                'name' => 'Client 1',
                'permission' => Fund::TYPES
            ])
            ->create();
        Client::factory()
            ->state([
                'name' => 'Client 2',
                'permission' => ['VC', 'RE']
            ])
            ->create();
        Client::factory()
            ->state([
                'name' => 'Client 3',
                'permission' => ['PL', 'PC']
            ])
            ->create();
    }
}
