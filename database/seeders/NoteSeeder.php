<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Note;
use App\Models\Supplier;
use App\Models\Fabric;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class NoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (Note::count() === 0 && User::count() > 0 && Supplier::count() > 0 && Fabric::count() > 0) {
            $user = User::first();
            $supplier = Supplier::first();
            $fabric = Fabric::first();

            DB::table('notes')->insert([
                [
                    'note' => 'This is a note for the first supplier.',
                    'notable_id' => $supplier->id,
                    'notable_type' => Supplier::class,
                    'added_by' => $user->id,
                    'updated_by' => null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'note' => 'This is a note for the first fabric.',
                    'notable_id' => $fabric->id,
                    'notable_type' => Fabric::class,
                    'added_by' => $user->id,
                    'updated_by' => null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            ]);
        }
    }
}