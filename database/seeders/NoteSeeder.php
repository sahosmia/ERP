<?php

namespace Database\Seeders;

use App\Models\Fabric;
use App\Models\Note;
use App\Models\Supplier;
use App\Models\User;
use Illuminate\Database\Seeder;

class NoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $suppliers = Supplier::all();
        $fabrics = Fabric::all();
        $users = User::all();

        if ($users->isEmpty()) {
            $this->command->info('No users found, creating one first.');
            User::factory()->create();
            $users = User::all();
        }

        foreach ($suppliers as $supplier) {
            Note::create([
                'notable_id' => $supplier->id,
                'notable_type' => Supplier::class,
                'note' => 'This is a sample note for a supplier.',
                'added_by' => $users->random()->id,
            ]);
        }

        foreach ($fabrics as $fabric) {
            Note::create([
                'notable_id' => $fabric->id,
                'notable_type' => Fabric::class,
                'note' => 'This is a sample note for a fabric.',
                'added_by' => $users->random()->id,
            ]);
        }
    }
}