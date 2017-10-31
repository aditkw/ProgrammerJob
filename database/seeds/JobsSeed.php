<?php

use Illuminate\Database\Seeder;
use App\Models\Job;

class JobsSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Job::create([
          'name'        => 'Web Developer',
          'slug'        => 'web-developer',
          'photo'        => 'web-developer.jpg',
          'salary'      => '3.000.000 - 5.000.000',
          'description' => 'Web developer adalah suatu pekerjaan untuk membuat suatu website...'
        ]);

        Job::create([
          'name'        => 'Android Developer',
          'slug'        => 'android-developer',
          'photo'        => 'android-developer.jpg',
          'salary'      => '3.500.000 - 6.000.000',
          'description' => 'Android developer adalah suatu pekerjaan untuk membuat suatu android app...'
        ]);

        Job::create([
          'name'        => 'Creative Web Designer',
          'slug'        => 'creative-web-designer',
          'photo'        => 'creative-web-designer.jpg',
          'salary'      => '2.500.000 - 4.000.000',
          'description' => 'Creative Web Designer adalah suatu pekerjaan untuk mendesain suatu front-end website...'
        ]);
    }
}
