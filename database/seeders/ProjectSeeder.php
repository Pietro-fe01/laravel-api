<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Type;
use Faker\Generator as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Schema;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        // To refresh every record in DB without rollback
        Schema::disableForeignKeyConstraints();
        Project::truncate();
        Schema::enableForeignKeyConstraints();

        for ($i=0; $i < 15; $i++) {
            $type = Type::inRandomOrder()->first(); // Get a random (full) record from Type Model

            $new_project = new Project();
            $new_project->project_title = $faker->sentence();
            $new_project->customer_name = $faker->company() . ' ' . $faker->companySuffix();
            $new_project->description = $faker->text(1500);
            $new_project->slug = Str::slug($new_project->project_title, '-');

            $new_project->type_id = $type->id; // From the full record get its id
            
            $new_project->save();
        }
    }
}
