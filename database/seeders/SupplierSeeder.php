<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Supplier;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (Supplier::count() === 0 && User::count() > 0) {
            $user = User::first();
            DB::table('suppliers')->insert([
                [
                    'country' => 'USA',
                    'company_name' => 'Test Supplier Inc.',
                    'code' => 'TS001',
                    'added_by' => $user->id,
                    'email' => 'contact@testsupplier.com',
                    'phone' => '123-456-7890',
                    'address' => '123 Test Street, Test City, USA',
                    'representative_name' => 'John Doe',
                    'representative_email' => 'john.doe@testsupplier.com',
                    'representative_phone' => '098-765-4321',
                    'updated_by' => null,
                    'created_at' => now(),
                    'updated_at' => now(),
                    'deleted_at' => null,
                ],
                [
                    'country' => 'Bangladesh',
                    'company_name' => 'BD Fabrics Ltd.',
                    'code' => 'BD001',
                    'added_by' => $user->id,
                    'email' => 'info@bdfabrics.com',
                    'phone' => '111-222-3333',
                    'address' => '456 Fabric Lane, Dhaka, Bangladesh',
                    'representative_name' => 'Jane Smith',
                    'representative_email' => 'jane.smith@bdfabrics.com',
                    'representative_phone' => '444-555-6666',
                    'updated_by' => null,
                    'created_at' => now(),
                    'updated_at' => now(),
                    'deleted_at' => null,
                ]
            ]);
        }
    }
}