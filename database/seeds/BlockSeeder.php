<?php

use Illuminate\Database\Seeder;
use App\User;

class BlockSeeder extends Seeder
{
    public function run()
    {
        //Manuelly add necessary Blocks
        if (($handle = fopen(base_path()."/database/csv/block.csv", "r")) !== false) {
            while (($data = fgetcsv($handle, 0, ",", "@")) !== false) {
                //$this->command->info(print_r($data));
                $admin = User::first();
                $admin->blocks()->create(
                    ['name' => $data[0],
                    'function' => $data[2],
                    'structure' => $data[1],
                    'category' => $data[3],
                    'description' => $data[4]]
                );
            }
            fclose($handle);
        }

    }
}
