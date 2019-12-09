<?php

use Illuminate\Database\Seeder;

class NavMenusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        foreach (range(1,6) as $index) {
            DB::table('nav_menus')->insert([
                'navtype' => $index,
                'name' => 'caterogy '.$index,
                'link' => 'category'.$index,
                'title' => 'category title ' . $index,
                'subtitle' => 'subtitle '. $index,
                'description' => 'description '.$index
            ]);
        }
    }
}
