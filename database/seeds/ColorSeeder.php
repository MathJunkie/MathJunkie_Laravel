<?php

use Illuminate\Database\Seeder;
class ColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $colors = [
            array("name" => "Variable",
                  "color"=> "330"),
            array("name" =>"Input",
                  "color"=> "50"),
            array("name" =>"Method",
                  "color"=> "290"),
            array("name" =>"Logic",
                  "color"=> "210"),
            array("name" =>"Loop",
                  "color"=> "120"),
            array("name" =>"Text",
                  "color"=> "160"),
            array("name" =>"Math",
                  "color" => "230"),
            array("name" =>"Base",
                  "color" => "60"),
            array("name" =>"List",
                "color" => "260"),
            array("name" =>"Colour",
                "color" => "20"),
        ];
        foreach ($colors as $key => $value){
            DB::table('category_color')->insert([
                'name' => $value["name"],
                'color' => $value["color"],
            ]);
        }
    }
}
