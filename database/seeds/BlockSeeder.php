<?php

use Illuminate\Database\Seeder;

class BlockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Manuelly add necessary Blocks
        if (($handle = fopen(base_path()."/database/csv/block.csv", "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 0, ",","@")) !== FALSE) {
                //$this->command->info(print_r($data));
                $admin = \DB::table('users')->first();
                DB::table('block')->insert([
                    'name' => $data[0],
                    'user_id' => $admin->id,
                    'function' => $data[2],
                    'structure' => $data[1],
                    'category' => $data[3],
                    'description' => $data[4],
                    'updated_at' => time(),
                    'created_at' => time(),
                ]);
            }
            fclose($handle);
        }

    }
}
