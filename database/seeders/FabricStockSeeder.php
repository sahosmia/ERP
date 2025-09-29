<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Fabric;
use App\Models\FabricStock;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class FabricStockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (FabricStock::count() === 0 && Fabric::count() > 0) {
            $fabrics = Fabric::all();
            foreach ($fabrics as $fabric) {
                DB::table('fabric_stocks')->insert([
                    [
                        'fabric_id' => $fabric->id,
                        'transaction_type' => 'in',
                        'qty' => $fabric->qty,
                        'barcode' => Str::random(12),
                        'created_at' => now(),
                        'updated_at' => now(),
                    ],
                ]);
            }
        }
    }
}