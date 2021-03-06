<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $this->call(UsersSeed::class);
      $this->call(JobsSeed::class);
      $this->call(RolesSeed::class);
    }
}
