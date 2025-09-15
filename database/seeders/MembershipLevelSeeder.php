<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\MembershipLevel;

class MembershipLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
   public function run(): void
{
    $levels = [
        ['name'=>'Basic',   'slug'=>'basic',   'duration_days'=>30,  'is_lifetime'=>false],
        ['name'=>'Premium', 'slug'=>'premium', 'duration_days'=>365, 'is_lifetime'=>false],
        ['name'=>'Lifetime','slug'=>'lifetime','duration_days'=>null,'is_lifetime'=>true],
        ['name'=>'Founder', 'slug'=>'founder', 'duration_days'=>null,'is_lifetime'=>true],
    ];

    foreach ($levels as $l) {
        MembershipLevel::updateOrCreate(['slug'=>$l['slug']], $l + ['price'=>0]);
    }
}
}
