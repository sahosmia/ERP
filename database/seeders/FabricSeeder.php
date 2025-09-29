<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Fabric;
use App\Models\Supplier;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class FabricSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (Fabric::count() === 0 && Supplier::count() > 0 && User::count() > 0) {
            $user = User::first();
            $supplier = Supplier::first();
            DB::table('fabrics')->insert([
                [
                    'fabric_no' => 'FAB-001',
                    'composition' => '100% Cotton',
                    'gsm' => '180',
                    'qty' => 1000.00,
                    'cuttable_width' => '58"',
                    'production_type' => 'Bulk',
                    'construction' => 'Single Jersey',
                    'color_pantone_code' => '19-4052 TCX',
                    'weave_type' => 'Knit',
                    'finish_type' => 'Bio-wash',
                    'dyeing_method' => 'Piece Dyed',
                    'printing_method' => 'N/A',
                    'lead_time' => '30 days',
                    'moq' => '500 kg',
                    'shrinkage' => '5%',
                    'remarks' => 'Standard quality cotton fabric.',
                    'fabric_selected_by' => 'Merchandiser A',
                    'image_path' => null,
                    'barcode' => Str::random(12),
                    'supplier_id' => $supplier->id,
                    'added_by' => $user->id,
                    'updated_by' => null,
                    'created_at' => now(),
                    'updated_at' => now(),
                    'deleted_at' => null,
                ],
                [
                    'fabric_no' => 'FAB-002',
                    'composition' => '95% Cotton 5% Spandex',
                    'gsm' => '220',
                    'qty' => 500.00,
                    'cuttable_width' => '60"',
                    'production_type' => 'SMS',
                    'construction' => 'Rib',
                    'color_pantone_code' => '18-3838 TCX',
                    'weave_type' => 'Knit',
                    'finish_type' => 'Enzyme Wash',
                    'dyeing_method' => 'Yarn Dyed',
                    'printing_method' => 'N/A',
                    'lead_time' => '45 days',
                    'moq' => '300 kg',
                    'shrinkage' => '7%',
                    'remarks' => 'For stretchable garments.',
                    'fabric_selected_by' => 'Designer B',
                    'image_path' => null,
                    'barcode' => Str::random(12),
                    'supplier_id' => $supplier->id,
                    'added_by' => $user->id,
                    'updated_by' => null,
                    'created_at' => now(),
                    'updated_at' => now(),
                    'deleted_at' => null,
                ]
            ]);
        }
    }
}