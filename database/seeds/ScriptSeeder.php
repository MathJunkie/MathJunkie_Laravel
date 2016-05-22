<?php

use Illuminate\Database\Seeder;
use App\User;

class ScriptSeeder extends Seeder
{
    public function run()
    {
        if (($handle = fopen(base_path()."/database/csv/script.csv", "r")) !== false) {
            while (($data = fgetcsv($handle, 0, ",", "@")) !== false) {
                //$this->command->info(print_r($data));
                $admin = User::first();
                $admin->scripts()->create(
                    [   'name' => $data[0],
                        'function' => $data[2],
                        'structure' => $data[1],
                        'description' => $data[3]]
                );
            }
            fclose($handle);
        }
    }
}
