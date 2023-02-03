<?php

namespace Database\Seeders;

use App\Models\Type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Refresh records quando viene invocato il db:seed
        Schema::disableForeignKeyConstraints();
        Type::truncate();
        Schema::enableForeignKeyConstraints();

        // projects' types
        $types = [
            'Business implementation',
            'Foundational (business improvement)',
            'IT infrastructure improvement',
            'Product development (IT)',
            'Product development (non-IT)',
            'Physical engineering/construction',
            'Physical infrastructure improvement',
            'Procurement',
            'Regulatory/compliance',
            'Research and Development (R&D)',
            'Service development',
            'Transformation/reengineering'
        ];

        // Save each Type in DB
        foreach ($types as $type) {
            $new_type = new Type();
            $new_type->name = $type;
            $new_type->slug = Str::of($new_type->name)->slug('-');
            $new_type->save();
        }
    }
}
