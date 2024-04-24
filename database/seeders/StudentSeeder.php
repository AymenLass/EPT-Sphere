<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Student;
use PhpOption\None;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Student::factory()->count(10)->create();
    $newIndex = 1 ;
    $students  = [
        [
            "st_id" => $newIndex++,
            "name" => "Aymen Lassoued",
            'session' => '2023-2026',
            'department' => 'Technologie',
            'c_class' => 'FirstY',
            'fathers_name' => 'unkown',
            'mothers_name' => 'unkown',
            'dob' => '03-03-2003',
            'gender' => "male",
            'phone' => '50723224',
            'email' => 'aymen.lassoued@ept.ucar.tn',
            'photo' => 'aymen-lassoued-1712453686.png',
            'present_address' => 'unkown',
            'permanent_address' => 'unkown',
            "birth_reg_nid" => "unkown",
            "Verify" =>"Pending" ,
            'ssc_res' => 'unkown',
            'ssc_board' => 'unkown',
            'ssc_dept' => 'unkown',
            'ssc_school' => 'unkown',
            'ssc_year' => 'unkown',
            'ssc_testimonial' => 'unkown',
            'ssc_marksheet' => 'unkown',
        ],

        [
            "st_id" => $newIndex++,
            "name" => "Nour Ben Ali",
            'session' => '2023-2026',
            'department' => 'Technologie',
            'c_class' => 'FirstY',
            'fathers_name' => 'unkown',
            'mothers_name' => 'unkown',
            'dob' => '01-01-2002',
            'gender' => "male",
            'phone' => 'uknown',
            'email' => 'nour.benali@ept.ucar.tn',
            'photo' => 'nour-ben-ali-1712453726.jpg',
            'present_address' => 'unkown',
            'permanent_address' => 'unkown',
            "birth_reg_nid" => "unkown",
            "Verify" =>"Pending" ,
            'ssc_res' => 'unkown',
            'ssc_board' => 'unkown',
            'ssc_dept' => 'unkown',
            'ssc_school' => 'unkown',
            'ssc_year' => 'unkown',
            'ssc_testimonial' => 'unkown',
            'ssc_marksheet' => 'unkown',
        ],
        [
            "st_id" => $newIndex++,
            "name" => "Yasmine Charradi",
            'session' => '2023-2026',
            'department' => 'Technologie',
            'c_class' => 'FirstY',
            'fathers_name' => 'unkown',
            'mothers_name' => 'unkown',
            'dob' => '01-01-2002',
            'gender' => "male",
            'phone' => 'unkown',
            'email' => 'yassmine.charradi@ept.ucar.tn',
            'photo' => 'yasmine-charradi-1712453762.jpg',
            'present_address' => 'unkown',
            'permanent_address' => 'unkown',
            "birth_reg_nid" => "unkown",
            "Verify" =>"Pending" ,
            'ssc_res' => 'unkown',
            'ssc_board' => 'unkown',
            'ssc_dept' => 'unkown',
            'ssc_school' => 'unkown',
            'ssc_year' => 'unkown',
            'ssc_testimonial' => 'unkown',
            'ssc_marksheet' => 'unkown',
        ],
        [
            "st_id" => $newIndex++,
            "name" => "Nacef M'barek",
            'session' => '2023-2026',
            'department' => 'Technologie',
            'c_class' => 'FirstY',
            'fathers_name' => 'unkown',
            'mothers_name' => 'unkown',
            'dob' => '01-01-2002',
            'gender' => "male",
            'phone' => 'unkown',
            'email' => 'nacef.mbarek@ept.ucar.tn',
            'photo' => 'nacef-mbarek-1712453977.jpg',
            'present_address' => 'unkown',
            'permanent_address' => 'unkown',
            "birth_reg_nid" => "unkown",
            "Verify" =>"Pending" ,
            'ssc_res' => 'unkown',
            'ssc_board' => 'unkown',
            'ssc_dept' => 'unkown',
            'ssc_school' => 'unkown',
            'ssc_year' => 'unkown',
            'ssc_testimonial' => 'unkown',
            'ssc_marksheet' => 'unkown',
        ],
        [
            "st_id" => $newIndex++,
            "name" => "Eya Machraoui",
            'session' => '2023-2026',
            'department' => 'Technologie',
            'c_class' => 'FirstY',
            'fathers_name' => 'unkown',
            'mothers_name' => 'unkown',
            'dob' => '01-01-2002',
            'gender' => "male",
            'phone' => 'unkown',
            'email' => 'eya.machraoui@ept.ucar.tn',
            'photo' => 'eya-machraoui-1712453815.jpg',
            'present_address' => 'unkown',
            'permanent_address' => 'unkown',
            "birth_reg_nid" => "unkown",
            "Verify" =>"Pending" ,
            'ssc_res' => 'unkown',
            'ssc_board' => 'unkown',
            'ssc_dept' => 'unkown',
            'ssc_school' => 'unkown',
            'ssc_year' => 'unkown',
            'ssc_testimonial' => 'unkown',
            'ssc_marksheet' => 'unkown',
        ],
        [
            "st_id" => $newIndex++,
            "name" => "Yessin Chaouachi",
            'session' => '2023-2026',
            'department' => 'Technologie',
            'c_class' => 'FirstY',
            'fathers_name' => 'unkown',
            'mothers_name' => 'unkown',
            'dob' => '01-01-2002',
            'gender' => "male",
            'phone' => 'unkown',
            'email' => 'yessin.chaouachi@ept.ucar.tn',
            'photo' => 'yessin-chaouachi-1712453925.jpg',
            'present_address' => 'unkown',
            'permanent_address' => 'unkown',
            "birth_reg_nid" => "unkown",
            "Verify" =>"Pending" ,
            'ssc_res' => 'unkown',
            'ssc_board' => 'unkown',
            'ssc_dept' => 'unkown',
            'ssc_school' => 'unkown',
            'ssc_year' => 'unkown',
            'ssc_testimonial' => 'unkown',
            'ssc_marksheet' => 'unkown',
        ],

    ];

    foreach ($students as $studentData) {
        Student::create($studentData);
    }
}
}
