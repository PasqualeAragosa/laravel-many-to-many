<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

//  IMPORTATI
use App\Models\Project;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i = 0; $i < 10; $i++) {
            $project = new Project();
            $project->title = $faker->sentence(3);
            $project->slug = Str::slug($project->title, '-');
            $project->cover_image = 'placeholders/' . $faker->image('storage/app/public/placeholders', 400, 200, 'Project', false, false);
            $project->description = $faker->text();
            $project->save();
        }
    }
}
