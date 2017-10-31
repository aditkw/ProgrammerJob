<?php

use Illuminate\Database\Seeder;

class RolesSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('roles')->insert([
          'slug' => 'admin',
          'name'  => 'Admin',
          "permissions" => '{"admin":true}',
      ]);

      DB::table('roles')->insert([
          'slug' => 'user',
          'name'  => 'User',
          "permissions" => '{"profile.edit":true,"profile.update":true,"profile.show":true,"job.show":true,"job.store":true,"job.reupload":true, "show.notif":true}'
      ]);


      DB::table('role_users')->insert([
          'user_id' => 1,
          'role_id' => 1,
      ]);

      for($i=2; $i<=10; $i++) {
          DB::table('role_users')->insert([
              'user_id' => $i,
              'role_id' => 2,
          ]);
        }
    }
}
