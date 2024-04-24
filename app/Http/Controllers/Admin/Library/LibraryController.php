<?php

namespace App\Http\Controllers\Admin\Library;

use Illuminate\Http\Request;




use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use App\Mail\ForgetPassEmail;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use \App\Mail\ApproveMail;


class LibraryController extends Controller
{
    public function notification()
    {

        $admin_status=Session::get('id');

        // if(! $admin_status)
        // {

        //     return Redirect::to('/admin');


        // }

        $notification=DB::table('students')->where('Verify','Panding')
        ->where('Read','No')
        ->get();

        $data=array();


        $data['Read']="Yes";


        $update=DB::table('students')->where('Read','No')->update($data);

        return view('admin.notification',compact('notification'));


    }



    public function shelf_details($id)
    {

        $admin_status=Session::get('id');

        // if(! $admin_status)
        // {

        //     return Redirect::to('/admin');


        // }

        $shelf=DB::table('shelfs')->where('id',$id)->first();


        $book=DB::table('books')->where('Shelf_ID',$shelf->Shelf_ID)->get();


        $shelf=DB::table('shelfs')->where('id',$id)->get();


        return view('admin.shelf_details',compact('book','shelf'));



    }
    public function book_details($id)
    {

        $admin_status=Session::get('id');

        // if(! $admin_status)
        // {

        //     return Redirect::to('/admin');


        // }

        $book=DB::table('books')->where('id',$id)->first();

        $records=DB::table('records')->where('Book_ID',$book->Book_ID)
        ->where('Submission_Status','No')
        ->get();

        $book=DB::table('books')->where('id',$id)->get();



        return view('admin.library_info.book_details',compact('book','records'));



    }





    public function add_order_process(Request $req)
    {

        $student=DB::table('students')->where('Verify','Approve')->where('st_id',$req->st_id)->count();

        if(! $student)
        {

            $notification = array(
                'message' => 'Wrong Student ID !',
                'alert-type' => 'error'
            );

           return back()->with($notification);


        }

        $book=DB::table('books')->where('Book_ID',$req->book_id)->count();

        if(! $book)
        {

            $notification = array(
                'message' => 'Wrong Book ID !',
                'alert-type' => 'error'
            );

           return back()->with($notification);


        }

        $again_order=DB::table('records')->where('Book_ID',$req->book_id)
        ->where('Student_ID',$req->student_id)
        ->where('Submission_Status','No')
        ->count();

        if($again_order)
        {

            $notification = array(
                'message' => 'Sorry, This book is already ordered for same student !',
                'alert-type' => 'error'
            );

           return back()->with($notification);


        }

        $data=array();

        $data['Book_ID']=$req->book_id;
        $data['Student_ID']=$req->student_id;

        date_default_timezone_set("Asia/Dhaka");

        $today=date("d-m-Y");

        $data['Collection_Date']=$today;

        $data['Submission_Status']="No";

        $data['Submission_Date']="N/A";

        $data['Read']="No";

        $expiredDate = date('d-m-Y', strtotime("+6 months", strtotime($today)));

        $data['Expired_Date']=$expiredDate;

        $add_order=DB::table('records')->Insert($data);

        if($add_order)
        {

            $book=DB::table('books')->where('Book_ID',$req->book_id)->first();

            $data2=array();

            $data2['Amounts']=$book->Amounts - 1;

            $remove_book=DB::table('books')->where('Book_ID',$req->book_id)->update($data2);

            if($remove_book)
            {

                $student=DB::table('students')->where('Student_ID',$req->student_id)->first();

                $details_order = [
                    'title' => 'Seminar Library Management System',
                    'body' => 'Book ID  - "'.$req->book_id.'" ordered for you. Expired Date - .'.$expiredDate
                ];

                Mail::to($student->Email)->send(new \App\Mail\BookOrderMail($details_order));


                $notification = array(
                    'message' => 'Successfully order completed !',
                    'alert-type' => 'success'
                );

               return back()->with($notification);



            }


        }

    }

    public function add_shelf()
    {

        $admin_status=Session::get('id');

        // if(! $admin_status)
        // {

        //     return Redirect::to('/admin');


        // }

        return view('admin.add_shelf');



    }
    public function add_shelf_process(Request $req)
    {


        $data=array();

        $data['Shelf_ID']=$req->shelf_id;
        $data['Shelf_Location']=$req->shelf_location;

        $unique_shelf=DB::table('shelfs')->where('Shelf_ID',$req->shelf_id)->count();

        if($unique_shelf > 0){

            $notification = array(
                'message' => 'Shelf ID already exits !',
                'alert-type' => 'error'
            );

           return back()->with($notification);


        }

        $add_shelf=DB::table('shelfs')->Insert($data);

        if($add_shelf)
        {
            $notification = array(
                'message' => 'Successfully added shelf !',
                'alert-type' => 'success'
            );

           return back()->with($notification);



        }

    }
    public function update_shelf()
    {

        $admin_status=Session::get('id');

        // if(! $admin_status)
        // {

        //     return Redirect::to('/admin');


        // }

        $shelf=DB::table('shelfs')->get();

        return view('admin.update_shelf',compact('shelf'));


    }
    public function edit_shelf($id)
    {


        $admin_status=Session::get('id');

        // if(! $admin_status)
        // {

        //     return Redirect::to('/admin');


        // }

        $shelf=DB::table('shelfs')->where('id',$id)->first();

        $books_amount=DB::table('books')->where('Shelf_ID',$shelf->Shelf_ID)->sum('amounts');

        $shelf=DB::table('shelfs')->where('id',$id)->get();


        return view('admin.library_info.edit_shelf',compact('shelf','books_amount'));



    }
    public function edit_shelf_process(Request $req,$id)
    {

        $data=array();

        $data['Shelf_Location']=$req->shelf_location;

        $update_shelf=DB::table('shelfs')->where('id',$id)->update($data);

        if($update_shelf)
        {

            $notification = array(
                'message' => 'Successfully updated shelf !',
                'alert-type' => 'success'
            );

           return back()->with($notification);


        }
        else{

            $notification = array(
                'message' => 'Already same location exits !',
                'alert-type' => 'error'
            );

           return back()->with($notification);


        }


    }
    public function remove_shelf()
    {

        $admin_status=Session::get('id');

        // if(! $admin_status)
        // {

        //     return Redirect::to('/admin');


        // }

        $shelf=DB::table('shelfs')->get();


        return view('admin.remove_shelf',compact('shelf'));



    }
    public function remove_shelf_process($id)
    {

        $shelf=DB::table('shelfs')->where('id',$id)->first();

        $books_amount=DB::table('books')->where('Shelf_ID',$shelf->Shelf_ID)->sum('amounts');

        if($books_amount > 0)
        {

            $notification = array(
                'message' => 'Already some books exits in this self !',
                'alert-type' => 'error'
            );

           return back()->with($notification);


        }

        $books_shelf=DB::table('records')->where('Shelf_ID',$shelf->Shelf_ID)->count();

        if($books_shelf > 0)
        {


            $notification = array(
                'message' => 'Already some books of the self exits in students  !',
                'alert-type' => 'error'
            );

           return back()->with($notification);



        }

        $delete_shelf=DB::table('shelfs')->where('id',$id)->delete();

        if($delete_shelf)
        {

            $notification = array(
                'message' => 'Successfully deleted shelf !',
                'alert-type' => 'success'
            );

           return back()->with($notification);


        }


    }

    public function networking_book()
    {

        $admin_status=Session::get('id');

        // if(! $admin_status)
        // {

        //     return Redirect::to('/admin');


        // }


        $book=DB::table('books')->where('Catagory','Networking')->get();




        return view('admin.book-list.networking',compact('book'));


    }
    public function database_book()
    {

        $admin_status=Session::get('id');

        // if(! $admin_status)
        // {

        //     return Redirect::to('/admin');


        // }


        $book=DB::table('books')->where('Catagory','Database')->get();




        return view('admin.book-list.database',compact('book'));


    }
    public function electronics_book()
    {

        $admin_status=Session::get('id');

        // if(! $admin_status)
        // {

        //     return Redirect::to('/admin');


        // }


        $book=DB::table('books')->where('Catagory','Electronics')->get();




        return view('admin.book-list.electronics',compact('book'));


    }
    public function software_book()
    {

        $admin_status=Session::get('id');

        // if(! $admin_status)
        // {

        //     return Redirect::to('/admin');


        // }


        $book=DB::table('books')->where('Catagory','Software Development')->get();




        return view('admin.book-list.software-development',compact('book'));


    }
    public function programming_book()
    {

        $admin_status=Session::get('id');

        // if(! $admin_status)
        // {

        //     return Redirect::to('/admin');


        // }


        $book=DB::table('books')->where('Catagory','Programming')->get();




        return view('admin.book-list.programming',compact('book'));


    }

    public function shelf_list()
    {

        $admin_status=Session::get('id');

        // if(! $admin_status)
        // {

        //     return Redirect::to('/admin');


        // }

        $shelf=DB::table('shelfs')->get();


        return view('admin.shelf_list',compact('shelf'));



    }

    public function book_received_process($id)
    {

        date_default_timezone_set("Asia/Dhaka");

        $today=date("d-m-Y");

        $data=array();

        $data['Submission_Date']=$today;

        $data['Submission_Status']="Yes";

        $update_status=DB::table('records')->where('id',$id)->update($data);

        if($update_status)
        {


            $book=DB::table('records')->where('id',$id)->first();

            $book2=DB::table('books')->where('Book_ID',$book->Book_ID)->first();

            $data2=array();

            $data2['Amounts']=$book2->Amounts + 1;

            $add_book=DB::table('books')->where('Book_ID',$book2->Book_ID)->update($data2);


            $student=DB::table('students')->where('Verify','Approve')->where('Student_ID',$book->st_id)->first();


            $details_received = [
                'title' => 'Seminar Library Management System',
                'body' => 'Book ID  - "'.$book->Book_ID.'" received by Admin. '
            ];

            Mail::to($student->Email)->send(new \App\Mail\BookReceiveMail($details_received));

            $notification = array(
                'message' => 'Successfully received !',
                'alert-type' => 'success'
            );

           return back()->with($notification);

        }


    }



    public function book_received()
    {

        $admin_status=Session::get('id');

        // if(! $admin_status)
        // {

        //     return Redirect::to('/admin');


        // }

        $book_order=DB::table('records')->where('Submission_Status','No')->get();


        return view('admin.library_info.book_received',compact('book_order'));



    }
    public function add_order()
    {

        $admin_status=Session::get('id');

        // if(! $admin_status)
        // {

        //     return Redirect::to('/admin');


        // }


        return view('admin.library_info.add_order');



    }


    public function book_order()
    {

        $admin_status=Session::get('id');

        // if(! $admin_status)
        // {

        //     return Redirect::to('/admin');


        // }

        $book_order=DB::table('records')->get();


        return view('admin.library_info.book_order_show',compact('book_order'));



    }

    public function student_reject($id)
    {


        $student=DB::table('students')->where('id',$id)->first();


        $reject=DB::table('students')->where('id',$id)->delete();



        if($reject)
        {

            $details_reject = [
                'title' => 'Seminar Library Management System',
                'body' => 'Opps! Your account is rejected.Please try again...'
            ];

            Mail::to($student->email)->send(new \App\Mail\RejectMail($details_reject));


            $notification = array(
                'message' => 'Successfully Rejected !',
                'alert-type' => 'success'
            );

            return back()->with($notification);


        }



    }


    public function student_approve($id)
    {

        $data=array();

        $data['Verify']="Approve";

        $student=DB::table('students')->where('id',$id)->first();

        $approve=DB::table('students')->where('id',$id)->update($data);

        if($approve)
        {

            $details_approve = [
                'title' => 'EPT Library Management System',
                'body' => 'Congrats! Your account is approved.Please login now...'
            ];

            try {
                // Send approval email
            Mail::to($student->email)->send(new ApproveMail($details_approve));
            } catch (\Exception $e) {
                 // Handle email sending error
                 return redirect()->route('admin.dashboard')->with('error', 'Failed to send approval email. Please try again.');
                }

            $notification = array(
                'message' => 'Successfully Approved !',
                'alert-type' => 'success'
            );

            return back()->with($notification);


        }



    }





    public function edit_book_process(Request $req,$id)
    {

        if($req->amounts < 0)
        {

            $notification = array(
                'message' => 'Amounts of Book is not Negative !',
                'alert-type' => 'error'
            );

           return back()->with($notification);


        }

        $data=array();

        $data['Shelf_ID']=$req->shelf_id;
        $data['Amounts']=$req->amounts;

        $update_book=DB::table('books')->where('id',$id)->update($data);

        if($update_book)
        {

            $notification = array(
                'message' => 'Successfully updated book !',
                'alert-type' => 'success'
            );

           return back()->with($notification);


        }
        else{

            $notification = array(
                'message' => 'Same data already exits !',
                'alert-type' => 'error'
            );

           return back()->with($notification);


        }


    }

    public function edit_book($id)
    {

        $admin_status=Session::get('id');

        // if(! $admin_status)
        // {

        //     return Redirect::to('/admin');


        // }

        $books=DB::table('books')->where('id',$id)->get();

        $shelf=DB::table('shelfs')->get();

        return view('admin.library_info.edit_books',compact('books','shelf'));




    }
    public function update_book()
    {

        $admin_status=Session::get('id');

        // if(! $admin_status)
        // {

        //     return Redirect::to('/admin');


        // }

        $books=DB::table('books')->get();

        return view('admin.library_info.update_books',compact('books'));



    }

    public function add_book_process(Request $req)
    {

        if($req->amounts <=0)
        {

            $notification = array(
                'message' => 'Amounts of Book is not Negative or Zero !',
                'alert-type' => 'error'
            );

           return back()->with($notification);


        }

        $check_book=DB::table('books')->where('Book_ID',$req->book_id)->count();

        if($check_book > 0)
        {

            $notification = array(
                'message' => 'Book ID already exits !',
                'alert-type' => 'error'
            );

           return back()->with($notification);


        }

        $data=array();
        $data['Book_ID']=$req->book_id;
        $data['Book_Name']=$req->book_name;
        $data['Writer_Name']=$req->writer_name;
        $data['Catagory']=$req->catagory;
        $data['Shelf_ID']=$req->shelf_id;
        $data['Amounts']=$req->amounts;

        $add_book=DB::table('books')->Insert($data);

        if($add_book)
        {

            $notification = array(
                'message' => 'Sucessfully Added Book',
                'alert-type' => 'success'
            );

           return back()->with($notification);


        }


    }

    public function add_book()
    {

        $admin_status=Session::get('id');

        // if(! $admin_status)
        // {

        //     return Redirect::to('/admin');


        // }

        $shelf=DB::table('shelfs')->get();

        return view('admin.library_info.add_book',compact('shelf'));





    }


    public function remove_book_process($id)
    {

        $book=DB::table('books')->where('id',$id)->first();

        $student_copy=DB::table('records')->where('Book_ID',$book->Book_ID)
        ->where('Submission_Status','No')
        ->count();

        if($student_copy > 0)
        {

            $notification = array(
                'message' => 'Student has already this book !',
                'alert-type' => 'error'
            );

           return back()->with($notification);



        }

        $book=DB::table('books')->where('id',$id)->first();


        if($book->Amounts > 0)
        {


            $notification = array(
                'message' => 'Shelf has already this book !',
                'alert-type' => 'error'
            );

           return back()->with($notification);



        }


        $delete_book=DB::table('books')->where('id',$id)->delete();

        if($delete_book)
        {

            $notification = array(
                'message' => 'Successfully deleted book !',
                'alert-type' => 'success'
            );

           return back()->with($notification);



        }



    }

    public function remove_book()
            {

                $admin_status=Session::get('id');

                // if(! $admin_status)
                // {

                //     return Redirect::to('/admin');


                // }

                $books=DB::table('books')->get();


                return view('admin.library_info.remove_books',compact('books'));



            }
    public function sign_in_show()
    {

        return view('admin.sign_in');


    }
    public function forget_password()
    {

        return view('admin.forget_password');



    }
    public function forget_password_process(Request $req)
    {
        $email=DB::table('admins')->where('Email',$req->email)->count();

        if($email == 0)
        {

            $notification = array(
                'message' => 'Email is not registered !',
                'alert-type' => 'error'
            );

            return back()->with($notification);


        }
        $auto_number=rand(10000000,9999999999);

        Session::put('Admin_Email',$req->email);

        Session::put('link_number_admin',$auto_number);

        $details2 = [
            'title' => 'Seminar Library Management System',
            'body' => 'Please quickly change your password by link (Between 30 Minutes) - http://localhost:8000/admin/recover-password/'.$auto_number
        ];

        Mail::to($req->email)->send(new ForgetPassEmail($details2));

        $notification = array(
            'message' => 'Successfully Email Sent ! Check your Email',
            'alert-type' => 'info'
        );

        return back()->with($notification);


    }
    public function recover_password()
    {

        return view('admin.change_password');


    }
    public function recover_password_process(Request $req)
    {

        $email=Session::get('Admin_Email');

        $student=DB::table('admins')->where('Email',$email)->first();



            if($req->new_password == $req->confirm_password)
            {

                $data=array();
                $pass=Hash::make($req->new_password);
                $data['Password']=$pass;
                $update_password=DB::table('admins')->where('Email',$email)->update($data);

                if($update_password)
                {

                    $notification = array(
                        'mess2' => 'Sucessfully Change Password !',

                    );
                    Session::put('link_number_admin',null);
                    return Redirect::to('/admin')->with($notification);

                }
                else{

                    $notification = array(
                        'message' => 'Time is over !',
                        'alert-type' => 'error'
                    );

                    return back()->with($notification);


                }


            }
            else{

                $notification = array(
                    'message' => 'Password do not match !',
                    'alert-type' => 'error'
                );

                return back()->with($notification);



            }







    }
    public function sign_in_process(Request $req)
    {

        $email = DB::table('admins')->where('Email',$req->email)->count();

        $username = DB::table('admins')->where('Username',$req->email)->count();

        if($email > 0 || $username > 0)
        {

                if($email > 0)
                {

                    $admin = DB::table('admins')->where('Email',$req->email)->first();




                }
                if($username > 0)
                {

                    $admin = DB::table('admins')->where('Username',$req->email)->first();




                }

                if(Hash::check($req->password,$admin->Password) || $req->password==$admin->Password)
                {


                    Session::put('id',$admin->id);

                    return Redirect::to('/admin/dashboard');


                }
                else{

                    $notification = array(
                        'message' => 'Wrong Password !',
                        'alert-type' => 'error'
                    );

                   return back()->with($notification);



                }


        }
        else{

            $notification = array(
                'message' => 'Wrong Username or Email !',
                'alert-type' => 'error'
            );

            return back()->with($notification);


        }


    }
    public function dashboard()
    {
        // $menu = 'Library_Dashboard';
        // $submenu = 'first';
        $admin_status=Session::get('id');

        // if(! $admin_status)
        // {

        //      return Redirect::to('/admin');


        // }

        $total_student=DB::table('students')->count();
        $total_book=DB::table('books')->sum('Amounts');
        $total_shelf=DB::table('shelfs')->count();
        $total_order=DB::table('records')->where('Submission_Status','No')->count();

        $records=DB::table('records')->where('Submission_Status','No')->orderBy('id','desc')->paginate(3);


        return view('admin.library_info.dashboard', compact('total_student', 'total_book', 'total_shelf', 'total_order', 'records'));



    }
    public function log_out()
    {

        Session::put('id',null);

        return Redirect::to('/admin');

    }
    public function student_request()
    {

        $admin_status=Session::get('id');

        // if(! $admin_status)
        // {

        //     return Redirect::to('/admin');


        // }

        $student=DB::table('students')->where('Verify','Panding')->get();
        $student=DB::table('students')->get();


        return view('admin.library_info.student_request',compact('student'));


    }
    public function change_password()
    {

        $admin_status=Session::get('id');

        // if(! $admin_status)
        // {

        //     return Redirect::to('/admin');


        // }

        return view('admin.change_auth_password');



    }
    public function change_password_process(Request $req)
    {

        $admin=Session::get('id');

        $admin_account=DB::table('admins')->where('id',$admin)->first();


        if(Hash::check($req->old_password,$admin_account->Password) || $req->old_password==$admin_account->Password)
        {

            if($req->new_password==$req->confirm_password)
            {

                $req->new_password=Hash::make($req->new_password);

                $data=array();

                $data['Password']=$req->new_password;

                $update_password=DB::table('admins')->where('id',$admin)->update($data);

                if($update_password)
                {


                    $notification = array(
                        'message' => 'Successfully change password !',
                        'alert-type' => 'success'
                    );

                    return back()->with($notification);




                }
                else
                {

                    $notification = array(
                        'message' => 'Same password is exits !',
                        'alert-type' => 'error'
                    );

                    return back()->with($notification);




                }

            }
            else
            {

                $notification = array(
                    'message' => 'Password do not match !',
                    'alert-type' => 'error'
                );

                return back()->with($notification);



            }



        }
        else
        {

            $notification = array(
                'message' => 'Wrong Old Password !',
                'alert-type' => 'error'
            );

            return back()->with($notification);



        }




    }
    public function edit_info()
    {

        $admin_status=Session::get('id');

        // if(! $admin_status)
        // {

        //     return Redirect::to('/admin');


        // }

        $admin=DB::table('admins')->where('id',$admin_status)->get();

        return view('admin.edit_info',compact('admin'));



    }
    public function update_info_process(Request $req)
    {

        $data=array();

        $admin_status=Session::get('id');

        $data['Username']=$req->username;

        $check_username=DB::table('admins')->where('Username',$req->username)->count();

        if($check_username > 0)
        {

            $notification = array(
                'message' => 'Username already exits !',
                'alert-type' => 'error'
            );

            return back()->with($notification);


        }

        $update_info=DB::table('admins')->where('id',$admin_status)->update($data);

        if($update_info)
        {

            $notification = array(
                'message' => 'Successfully updated info !',
                'alert-type' => 'success'
            );

            return back()->with($notification);



        }



    }
}
