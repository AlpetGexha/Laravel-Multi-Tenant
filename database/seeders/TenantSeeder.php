<?php

namespace Database\Seeders;

use App\Models\Tenant;
use App\Models\User;
use Illuminate\Database\Seeder;

class TenantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $domains = [
            'Alpet',
            'Blog',
            'Service',
            'Shop',
            'Dashboard',
        ];

        foreach ($domains as $domain) {
            $tenant = Tenant::create(['id' => $domain]);

            $tenant->domains()->create([
                'domain' => $domain . '. localhost',
            ]);
        }

        Tenant::all()->runForEach(function () {
            User::factory()->create();
        });
    }
}
