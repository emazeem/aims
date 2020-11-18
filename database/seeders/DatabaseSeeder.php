<?php

namespace Database\Seeders;

use App\Models\InvoicingLedger;
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
        /*$this->call([
            InvoicingLedgerSeeder::class,
        ]);*/

        /*InvoicingLedger::factory()
            ->times(50)
            ->create();*/

        InvoicingLedger::factory(500)->create();
        // User::factory(10)->create();
    }
}
