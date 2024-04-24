<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{
    //__Homepage view
    public function index()
    {
        $posts = DB::table('posts')
                ->leftjoin('users', 'users.id', '=', 'posts.user_id')
                ->leftjoin('students', 'users.email', 'students.email')
                ->select('posts.*', 'users.name', 'users.user_image', 'students.department')
                ->where('visibility', '=', '1')
                ->orderBy('posts.post_date', 'desc')
                ->paginate(10);

        $peoples = DB::table('users')
                ->inRandomOrder()
                ->paginate(10);

        return view('home', compact('posts', 'peoples'));
    }

    //__User profile view
    public function profile($id)
    {
        $user = DB::table('users')->leftjoin('students', 'users.email', 'students.email')->select('users.*', 'students.department')->where('users.id', '=', $id)->first();

        if(Auth::user()->id == $user->id) {
            $posts = DB::table('posts')
                ->leftjoin('users', 'users.id', '=', 'posts.user_id')
                ->select('posts.*', 'users.name', 'users.user_image', 'users.created_at')
                ->where('posts.user_id', '=', $id)
                ->orderBy('posts.post_date', 'desc')
                ->paginate(10);
        }
        else {
            $posts = DB::table('posts')
                ->leftjoin('users', 'users.id', '=', 'posts.user_id')
                ->select('posts.*', 'users.name', 'users.user_image', 'users.created_at')
                ->where('posts.user_id', '=', $id)
                ->where('visibility', '=', '1')
                ->orderBy('posts.post_date', 'desc')
                ->paginate(10);
        }

        $xi_marks_mt = $xi_marks_hy = $xi_marks_fnl = $xii_marks_mt = $xii_marks_hy = $xii_marks_fnl = 0;

        if(Auth::user()->id == $user->id) {
            $xi_marks_mt = DB::table('model_test_exam')->leftjoin('students', 'model_test_exam.st_id', 'students.id')->select('model_test_exam.*', 'students.email')->where('students.email', $user->email)->where('model_test_exam.c_class', 'FirstY')->first();
            $xi_marks_hy = DB::table('half_yearly_exam')->leftjoin('students', 'half_yearly_exam.st_id', 'students.id')->select('half_yearly_exam.*', 'students.email')->where('students.email', $user->email)->where('half_yearly_exam.c_class', 'FirstY')->first();
            $xi_marks_fnl = DB::table('final_exam')->leftjoin('students', 'final_exam.st_id', 'students.id')->select('final_exam.*', 'students.email')->where('students.email', $user->email)->where('final_exam.c_class', 'FirstY')->first();

            $xii_marks_mt = DB::table('model_test_exam')->leftjoin('students', 'model_test_exam.st_id', 'students.id')->select('model_test_exam.*', 'students.email')->where('students.email', $user->email)->where('model_test_exam.c_class', 'SecondY')->first();
            $xii_marks_hy = DB::table('half_yearly_exam')->leftjoin('students', 'half_yearly_exam.st_id', 'students.id')->select('half_yearly_exam.*', 'students.email')->where('students.email', $user->email)->where('half_yearly_exam.c_class', 'SecondY')->first();
            $xii_marks_fnl = DB::table('final_exam')->leftjoin('students', 'final_exam.st_id', 'students.id')->select('final_exam.*', 'students.email')->where('students.email', $user->email)->where('final_exam.c_class', 'SecondY')->first();
        }

        return view('user.profile', compact('user', 'posts', 'xi_marks_mt', 'xi_marks_hy', 'xi_marks_fnl', 'xii_marks_mt', 'xii_marks_hy', 'xii_marks_fnl'));
    }


    //__View videos
    public function videos()
    {
        $videos = DB::table('posts')
                ->leftjoin('users', 'users.id', '=', 'posts.user_id')
                ->leftjoin('students', 'users.email', 'students.email')
                ->select('posts.*', 'users.name', 'users.user_image', 'students.department')
                ->where('video', '!=', 'NULL')
                ->where('visibility', '=', '1')
                ->orderBy('posts.post_date', 'desc')
                ->paginate(10);

        $peoples = DB::table('users')
                ->inRandomOrder()
                ->paginate(10);

        return view('user.videos', compact('videos', 'peoples'));
    }


    //__View Routines
    public function routines() {

        $xi_routine = DB::table('class_routine_xi')->get();
        $xii_routine = DB::table('class_routine_xii')->get();

        return view('user.routine.routines', compact('xi_routine', 'xii_routine'));
    }
    //__Print or download routine
    public function export($class, $dept)
    {
        if($class == 'FirstY') {
            $data = DB::table('class_routine_xi')->get();
        }
        else {
            $data = DB::table('class_routine_xii')->get();
        }

        return view('user.routine.print', compact('data', 'dept', 'class'));
    }

    //__Teacher and student info
    public function teacher_student_view()
    {
        $teacher = DB::table('teachers')->get();
        $student = DB::table('students')->get();

        return view('user.teacher_student_info.index', compact('teacher', 'student'));
    }


    //New ones

    public function resto_view()
    {
        $peoples = DB::table('users')
        ->inRandomOrder()
        ->paginate(10);

        return view('user.resto', compact('peoples'));
    }


    public function biblio_view()
    {
        $peoples = DB::table('users')
                   ->inRandomOrder()
                   ->paginate(10);


        return view('user.library', compact('peoples'));
    }


    public function s_dashboard_view()

        {
            $user = DB::table('users')
            ->inRandomOrder()
            ->paginate(10);

            $shelf=DB::table('shelfs')->get();

            $book = DB::table('books')->where('Catagory','Electronics')->get();
            $student = DB::table('students')->get();

            $books=DB::table('books')->get();

            $total_student=DB::table('students') ;
            return view('user.dashboard', compact('user', 'book' , 'shelf' ,"books" , "total_student" ));
        }



        public function my_collection_view()
        {
            $user_status = Session::get('id');

            // Check if the user status exists in the session
            // if(!$user_status) {
            //     return redirect()->to('/');
            // }

            $user = DB::table('users')->where('id', $user_status)->get();

            $collection = DB::table('records')->where('id', $user_status)
                                              ->where('Submission_Status', 'No')
                                              ->get();




            return view('user.my_collection',compact('user','collection'));




        }
    public function student_notification_view()

        {
            $user = DB::table('users')
            ->inRandomOrder()
            ->paginate(10);

            $shelf=DB::table('shelfs')->get();

            $book = DB::table('books')->where('Catagory','Electronics')->get();
            // $user = DB::table('students')->get();

            $books=DB::table('books')->get();

            $total_student=DB::table('students') ;
            // $student_status = Session::get('Student_ID');

        // if(! $student_status)
        // {

        //     return Redirect::to('/');



        // }

        // $user=DB::table('user')->where('id',$student_status)->first();

        $records=DB::table('records')
        ->where('Submission_Status','No')
        ->where('Read','No')
        ->get();


        date_default_timezone_set("Asia/Dhaka");
        $today=date("d-m-Y");







        $data=array();


        $data['Read']="Yes";


        $update_read = DB::table('records')
     // Filter records where Student_ID matches $user->st_id
        ->where('Read', 'No')               // Filter records where Read is 'No'
        ->update($data);                    // Update matching records with $data


        // $student=DB::table('students')->where('id',$student_status)->get();



        return view('user.notification',compact('user','records'));
        // return view('user.notification', compact('user', 'book' , 'shelf' ,"student","books" , "total_student" ));
        }

    public function dorms_view()
    {
        $peoples = DB::table('users')
                   ->inRandomOrder()
                   ->paginate(10);


        return view('user.dorms', compact('peoples'));
    }

    public function programming_book_student()
    {

        $user_status=Session::get('id');

        // if(! $student_status)
        // {

        //     return Redirect::to('/');



        // }
        $user=DB::table('users')->where('id',$user_status)->get();


        $book=DB::table('books')->where('Catagory','Programming')->get();



        return view('user.programming_book', compact('user', 'book'));



    }


    public function networking_book_student()
    {

        $user_status=Session::get('id');

        // if(! $student_status)
        // {

        //     return Redirect::to('/');



        // }
        $user=DB::table('users')->where('id',$user_status)->get();


        $book=DB::table('books')->where('Catagory','Networking')->get();




        return view('user.Networking_book',compact('user','book'));


    }


    public function database_book_student()
    {

        $user_status=Session::get('id');

        // if(! $student_status)
        // {

        //     return Redirect::to('/');



        // }
        $user=DB::table('users')->where('id',$user_status)->get();


        $book=DB::table('books')->where('Catagory','Database')->get();




        return view('user.database_book',compact('user','book'));


    }

    public function electronics_book_student()
    {

        $user_status=Session::get('id');

        // if(! $student_status)
        // {

        //     return Redirect::to('/');



        // }
        $user=DB::table('users')->where('id',$user_status)->get();


        $book=DB::table('books')->where('Catagory','Electronics')->get();




        return view('user.electronics_book',compact('user','book'));


    }



    public function software_book_student()
    {

        $user_status=Session::get('id');

        // if(! $student_status)
        // {

        //     return Redirect::to('/');



        // }
        $user=DB::table('users')->where('id',$user_status)->get();


        $book=DB::table('books')->where('Catagory','Softaware')->get();




        return view('user.book-list.software_book',compact('user','book'));


    }
    public function dashboard_view()
    {
        $user = DB::table('users')
        ->inRandomOrder()
        ->paginate(10);

        $shelf=DB::table('shelfs')->get();

        $book = DB::table('books')->where('Catagory','Electronics')->get();
        $student = DB::table('students')->get();

        $books=DB::table('books')->get();

        $total_student=DB::table('students') ;
        return view('user.dashboard', compact('user', 'book' , 'shelf' ,"student","books" , "total_student" ));
    }



    public function shelf_list_student()
    {

        $user_status=Session::get('id');

        // if(! $student_status)
        // {

        //     return Redirect::to('/');



        // }
        $user=DB::table('users')->where('id',$user_status)->get();




        $shelf=DB::table('shelfs')->get();


        return view('user.shelf_list',compact('user','shelf'));




    }



    public function my_submission()
    {

        $user_status=Session::get('id');

        // if(! $student_status)
        // {

        //     return Redirect::to('/');



        // }
        $user=DB::table('users')->where('id',$user_status)->get();


        $submission=DB::table('records')->where('id', $user_status)
        ->where('Submission_Status','Yes')
        ->get();

        $user=DB::table('users')->where('id',$user_status)->get();


        return view('user.my_submission',compact('user','submission'));




    }



    public function shelf_details_student($id)
    {

        $user_status=Session::get('id');

        // if(! $student_status)
        // {

        //     return Redirect::to('/');



        // }
        $user=DB::table('users')->where('id',$user_status)->get();

        $shelf=DB::table('shelfs')->where('id',$id)->first();


        $book=DB::table('books')->where('Shelf_ID',$shelf->Shelf_ID)->get();


        $shelf=DB::table('shelfs')->where('id',$id)->get();


        return view('user.shelf_details',compact('user','book','shelf'));



    }

}
