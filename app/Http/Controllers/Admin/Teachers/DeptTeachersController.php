<?php

namespace App\Http\Controllers\Admin\Teachers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;use Illuminate\Support\Str;
use Auth;
use Image;
use File;

class DeptTeachersController extends Controller
{
    public function science()
    {
        $teacher = DB::table('teachers')->where('department', 'Science')->get();
        $dept = 'Science';
        return view('admin.teachers.teachers_dept', compact('teacher', 'dept'));
    }

    public function Technologie()
    {
        $teacher = DB::table('teachers')->where('department', 'Technologie')->get();
        $dept = 'Technologie';
        return view('admin.teachers.teachers_dept', compact('teacher', 'dept'));
    }

    public function business()
    {
        $teacher = DB::table('teachers')->where('department', 'Business')->get();
        $dept = 'Business';
        return view('admin.teachers.teachers_dept', compact('teacher', 'dept'));
    }
}
