<?php

namespace Database\Seeders;

use App\Models\Fabric;
use App\Models\FabricStock;
use Illuminate\Database\Seeder;

class FabricStockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $fabrics = Fabric::all();

        foreach ($fabrics as $fabric) {
            // Create an initial stock-in transaction
            FabricStock::create([
                'fabric_id' => $fabric->id,
                'transaction_type' => 'in',
                'qty' => $fabric->qty,
                'barcode' => 'STOCK-IN-' . $fabric->barcode,
            ]);

            // Create a few stock-out transactions
            for ($i = 0; $i < rand(1, 3); $i++) {
                $outQty = round($fabric->qty * (rand(5, 15) / 100), 2); // Issue 5-15% of stock
                FabricStock::create([
                    'fabric_id' => $fabric->id,
                    'transaction_type' => 'out',
                    'qty' => $outQty,
                    'barcode' => 'STOCK-OUT-' . $fabric->barcode . '-' . ($i + 1),
                ]);
            }
        }
    }
}