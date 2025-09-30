<?php

namespace Database\Seeders;

use App\Models\Fabric;
use App\Models\Supplier;
use Illuminate\Database\Seeder;

class FabricSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $suppliers = Supplier::all();

        if ($suppliers->isEmpty()) {
            $this->command->info('No suppliers found, creating some first.');
            Supplier::factory(5)->create();
            $suppliers = Supplier::all();
        }

        foreach ($suppliers as $supplier) {
            Fabric::factory(rand(2, 5))->create([
                'supplier_id' => $supplier->id,
            ]);
        }
    }
}