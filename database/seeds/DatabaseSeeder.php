<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
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
        $this->call(ScriptSeeder::class);
        $this->call(ColorSeeder::class);

        //Create standard Blocks
        //composer dump-autoload
        //Create test comments
        if (getenv('APP_ENV') !== 'production'){
            factory(App\User::class, 2)->create()->each(function ($u) {
                $u->blocks()->save(factory(App\Block::class)->make());
                $u->scripts()->save(factory(App\Script::class)->make());
                $u->comments()->save(factory(App\Kommentar::class, 'block_comment')->make());
                $u->comments()->save(factory(App\Kommentar::class, 'script_comment')->make());
            });
        }
        Model::reguard();
    }
}
