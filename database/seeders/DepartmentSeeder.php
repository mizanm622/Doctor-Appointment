<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Department::factory()->create(); use factory
        $data= array(
            'Physical medicine and rehabilitation',
            'Psychiatry',
            'Orthopedics',
            'Cardiology',
            'Neurology',
            'Pulmonology',
        );
      foreach($data as $name){
        Department::create([
            'name'=>$name,
        ]);
    }




    }
}
