<?php

use Illuminate\Database\Seeder;
use App\category_color;
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
                  "color"=> "210"),
            array("name" =>"Method",
                  "color"=> "150"),
            array("name" =>"Logic",
                  "color"=> "20"),
            array("name" =>"Loop",
                  "color"=> "65"),
            array("name" =>"Text",
                  "color"=> "120"),
            array("name" =>"Output",
                  "color"=> "160"),
            array("name" =>"Math",
                  "color" => "0"),
            array("name" =>"Base",
                  "color" => "230"),
        ];
        foreach ($colors as $key => $value){
            $color = new category_color();
            $color->name = $value["name"];
            $color->color = $value["color"];
            $color->save();
        }
    }
}
