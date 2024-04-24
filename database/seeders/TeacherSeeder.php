<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Teacher;

class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    // public function run()
    // {
    //     /*
    //     Teacher::factory()->count(10)->create();
    //     */
    // }

    public function run()
    {
        $maxId = Teacher::max('id');
        $newIndex = $maxId + 1;
        // Define the teachers data statically
        $teachers = [
            [
                "index" => $newIndex,
                'name' => 'Imen Bennour',
                'position' => 'Professor / Supervisor',
                'department' => 'Technologie',
                'subject' => 'School Project',
                'fathers_name' => 'unkown',
                'mothers_name' => 'unkown',
                'dob' => "2000-01-01",
                'gender' => 'female',
                'phone' => 'unkown',
                'email' => 'imen.bennour@ihet.ucar.tn',
                'photo' => 'imen-bennour-1712444174.jpg',
                'present_address' => 'unkown',
                "permanent_address" => "unkown",
                'nid' => 'unkown',
                'edu_qualification' => 'unkown',
                'salary' => 'unkown',
            ],
            [
                "index" => ++$newIndex, // Increment the index separately
                'name' => 'Yassine Hchaichi',
                'position' => 'Professor',
                'department' => 'Technologie',
                'subject' => 'Porbability and Satistics',
                'fathers_name' => 'Souaï Hachaïchi',
                'mothers_name' => 'unkown',
                'dob' => "1970-09-26",
                'gender' => 'male',
                'phone' => 'unkown',
                'email' => 'yassine.hachaichi@ept.ucar.tn',
                'photo' => 'yassine-hchaichi-1712444599.png',
                'present_address' => 'unkown',
                "permanent_address" => "unkown",
                'nid' => 'unkown',
                'edu_qualification' => 'PhD in Mathematics',
                'salary' => 'unkown',
            ],
            [
                "index" => ++$newIndex, // Increment the index separately
                'name' => 'Adel Trabelsi',
                'position' => 'Professor',
                'department' => 'Science',
                'subject' => 'Quantum Physics',
                'fathers_name' => 'unkown',
                'mothers_name' => 'unkown',
                'dob' => "1971-01-07",
                'gender' => 'Male',
                'phone' => 'unkown',
                'email' => 'adel.trabelsi@gmail.com',
                'photo' => 'adel-trabelsi-1712445010.jpeg',
                'present_address' => 'unkown',
                "permanent_address" => "unkown",
                'nid' => 'unkown',
                'edu_qualification' => 'Ph.D in Nuclear and Radiation Physics',
                'salary' => 'unkown',
            ]
        ];


        // Insert teachers into the database
        foreach ($teachers as $teacherData) {
            Teacher::create($teacherData);
        }
    }
}
