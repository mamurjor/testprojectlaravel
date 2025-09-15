<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\{Post, Category, User};
use Illuminate\Support\Str;


class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
  public function run(): void
{
$cats = collect(['News','Tutorials','Opinion','Releases'])->map(function($name){
return Category::firstOrCreate(['slug'=>Str::slug($name)], ['name'=>$name]);
});


User::factory()->create(['id'=>1, 'name'=>'Admin']);


Post::factory(20)->create()->each(function($post) use ($cats){
$post->categories()->sync($cats->random(rand(1,2))->pluck('id')->toArray());
});
}
}
