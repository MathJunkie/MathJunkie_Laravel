<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        //Delete Data
        DB::table('block')->delete();
        DB::table('comments')->delete();
        DB::table('password_resets')->delete();
        DB::table('scripts')->delete();
        DB::table('users')->delete();

        //Create Admin User
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@bomberus.de',
            'password' => bcrypt('admin'),
        ]);

        $this->call(BlockSeeder::class);

        //Create standard Blocks
        //composer dump-autoload
        if ( env('APP_ENV') == 'acceptance') {
            //Create test comments
            factory(App\User::class, 10)->create()->each(function($u) {
                $u->blocks()->save(factory(App\Block::class)->make());
                $u->scripts()->save(factory(App\Script::class)->make());
                $u->comments()->save(factory(App\Kommentar::class)->make());
            });
        }
        Model::reguard();
    }
}
