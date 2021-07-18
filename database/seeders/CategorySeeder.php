<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('task_category')->insert(
            [
            'name' => 'Health'
            ],
        );
        DB::table('task_category')->insert(
            [
            'name' => 'Lifestyle'
            ],
        );
        DB::table('task_category')->insert(
            [
            'name' => 'Profession'
            ],
        );

    }
}
