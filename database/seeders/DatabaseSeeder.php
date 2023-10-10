<?php

namespace Database\Seeders;

use App\Models\Seeder as AppSeeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         // Items to be skipped from SP8
        $skip = [];

        $seeders = [ 
           UserTableSeeder::class,
        ];  

         $seeded = AppSeeder::all()->pluck('seeder')->toArray();
        
         collect($seeders)->each(function($item) use ($seeded, $skip){
            
            if (env('APP_ENV') != 'testing') {
                // Seed if not already seeded
                if(!in_array($item, $seeded?:$skip)){
                    try {                        
                        $this->call($item);
                    } catch (\Exception $e) {
                        \Log::error("Exception while running Main Database Seeder : " . $e->getMessage());
                        \Log::error("Exception while running Main Database Seeder : " . $e->getTraceAsString());
                    }
                }
            } else {
                // Seed if not already seeded
                \Log::info("Seeding: " . $item);
                $this->call($item);
            }

            // Record the entry in the DB
            if(!in_array($item, $seeded)){
                AppSeeder::create([
                    'seeder'=>$item
                ]);
            }
         });
    }
}
