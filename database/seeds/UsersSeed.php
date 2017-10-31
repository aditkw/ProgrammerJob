<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class UsersSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    $faker = Faker::create();
    $user = [
        'email' => 'admin@admin.com',
        'password' => 'admin',
    ];
    Sentinel::registerAndActivate($user);

    DB::table('users')->where('id', 1)->update([
        'status'  => 4,
    ]);


    DB::table('detail_users')->insert([
        'first_name' => 'admin',
        'last_name' => 'ganteng idaman',
        'gender'    => 'Pria',
        'phone'     =>  '089766644332',
        'photo'     =>  'avatar-male.png',
        'address'   => 'Di dalam kamar',
        'birth'     => date("Y-m-d H:i:s"),
        'country'   => 'Zimbabwe',
        'last_education'  => 'S2',
        'institute_name'  => 'MIT',
        'majors'        => 'Astronomy',
        'graduate_year' => '1999',
        'user_id'   => 1,
    ]);

    for($i=2; $i<=10; $i++) {
        $user = [
            'email' => $faker->email,
            'password' => 'secret',
        ];

        Sentinel::registerAndActivate($user);

        DB::table('users')->where('id', $i)->update([
            'status'  => 1,
        ]);

        DB::table('detail_users')->insert([
            'first_name' => $faker->firstName,
            'last_name' => $faker->lastName,
            'user_id'   => $i,
        ]);

      }
    }
}
