<?php

namespace Database\Seeders;

use App\Models\Ads;
use App\Models\Tag;
use Illuminate\Database\Seeder;

class AdsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Ads::factory()->count(20)->create();
        
        $tags = Tag::all();

        Ads::all()->each(function ($ads) use ($tags) {
            $ads->tags()->attach(
                $tags->random(rand(1, 3))->pluck('id')->toArray()
            );
        });
    }
}
