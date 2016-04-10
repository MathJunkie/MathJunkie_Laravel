<?php
/**
 * Created by IntelliJ IDEA.
 * User: Bomberus
 * Date: 10.04.2016
 * Time: 19:03
 */

DB::table('block')->insert([
    'name' => str_random(10),
    'email' => str_random(10).'@gmail.com',
    'password' => bcrypt('secret'),
]);