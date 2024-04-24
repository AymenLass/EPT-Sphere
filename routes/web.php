<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Auth\NewPasswordController;

use App\Http\Controllers\Admin\NoticeController;
use App\Http\Controllers\Admin\RoutineXIController;
use App\Http\Controllers\Admin\RoutineXIIController;

use App\Http\Controllers\Admin\Students\AllStudentsController;
use App\Http\Controllers\Admin\Students\XIStudentsController;
use App\Http\Controllers\Admin\Students\XIIStudentsController;
use App\Http\Controllers\Admin\Students\OldStudentsController;
use App\Http\Controllers\Admin\Students\HscExamineeController;

use App\Http\Controllers\Admin\Exam\ExamController;
use App\Http\Controllers\Admin\Exam\HscController;

use App\Http\Controllers\Admin\Teachers\TeachersController;
use App\Http\Controllers\Admin\Teachers\DeptTeachersController;

use App\Http\Controllers\Admin\Admission\SecurityCodeController;
use App\Http\Controllers\Admin\Admission\AdmissionController;

use App\Http\Controllers\Admin\Download\IDcardController;
use App\Http\Controllers\Admin\Download\TestimonialController;
use App\Http\Controllers\Admin\Download\TransCertController;

use App\Http\Controllers\User\NoticeViewController;

use App\Http\Controllers\User\Posts\PostsController;
use App\Http\Controllers\User\Posts\LikesController;
use App\Http\Controllers\User\Posts\CommentsController;
use App\Http\Controllers\Admin\Library\LibraryController ;
/*C:\Users\user\EPT Sphere\app\Http\Controllers\Admin\Library\LibraryCotroller.php
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::group(['middleware' => 'auth', 'middleware' => 'verified'], function() {
    //__Home routes
    Route::get('/home', [UserController::class, 'index'])->name('home');

    //__Change password
    Route::post('/user_password/update', [NewPasswordController::class, 'password_update'])->name('user_password.update');

    //__User profile routes
    Route::get('profile/{id}', [UserController::class, 'profile'])->name('user.profile');

    //__Notice routes
    Route::get('/notice', [NoticeViewController::class, 'index'])->name('notice.view');

    //__Post routes
    Route::resource('/posts', PostsController::class);
    Route::resource('/posts/like', LikesController::class);
    Route::resource('/posts/comment', CommentsController::class);

    //__Videos route
    Route::get('/videos', [UserController::class, 'videos'])->name('videos');

    //__Routine route
    Route::get('/routines', [UserController::class, 'routines'])->name('routines');
    Route::get('/routines/export/{class}/{dept}', [UserController::class, 'export'])->name('routines.export');

    //__Teachers and students info route
    Route::get('/teacher_student_info', [UserController::class, 'teacher_student_view'])->name('teacher_student_info');
    //new routes
    Route::get('/restaurant_info', [UserController::class, 'resto_view'])->name('restaurant_info');
    Route::get('/library_info', [UserController::class, 'biblio_view'])->name('library_info');
    Route::get('/dorms_info', [UserController::class, 'dorms_view'])->name('dorms_info');
    Route::get('/library_dashboard', [UserController::class, 'dashboard_view'])->name('library_dashboard');
    Route::get('student/dashboard',[UserController::class, 's_dashboard_view'])->name('student.dashboard');
    Route::get('student/notification', [UserController::class, 'student_notification_view'])->name('user.notification');
    Route::get('student/my-collection',[UserController::class, 'my_collection_view'])->name('student.my-collection');;





    Route::get('student/book-list/programming/',[UserController::class, 'programming_book_student'])->name('student.book-list.programming');
    Route::get('student/book-list/programming/',[UserController::class, 'programming_book_student'])->name('user.programming_book');

    // Route::get('student/book-list/networking/',[UserController::class, 'networking_book_student'])->name('student.book-list.networking');;
    Route::get('student/book-list/networking/',[UserController::class, 'networking_book_student'])->name('user.Networking_book');

    // Route::get('student/book-list/database/',[UserController::class, 'database_book_student'])->name('student.book-list.database');;
    Route::get('student/book-list/database/',[UserController::class, 'database_book_student'])->name('user.database_book');

    // Route::get('student/book-list/electronics/',[UserController::class, 'electronics_book_student'])->name('student.book-list.electronics');;
    Route::get('student/book-list/electronics/',[UserController::class, 'electronics_book_student'])->name('user.electronics_book');

    // Route::get('student/book-list/software-development/',[UserController::class, 'software_book_student'])->name('student.book-list.software-development');
    Route::get('student/book-list/software-development/',[UserController::class, 'software_book_student'])->name('user.software-development');


    Route::get('student/shelf/details/{id}', [UserController::class, 'shelf_details_student'])->name('student.shelf.details');
    Route::get('student/my-submission',[UserController::class, 'my_submission'])->name('student.submission');
    Route::get('student/shelf-list', [UserController::class, 'shelf_list_student'])->name('student.shelf-list');
});


// __Admission routes
Route::get('/admission/procedure', function () {
    return view('admission.admission_procedure');
})->name('admission.procedure');

Route::post('/student/admission/store', [AdmissionController::class, 'store'])->name('student.admission.store');


require __DIR__.'/auth.php';


/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::get('/admin/login', [AuthenticatedSessionController::class, 'create'])->name('admin.login')->middleware('guest:admin');
Route::post('/admin/login/store', [AuthenticatedSessionController::class, 'store'])->name('admin.login.store');

Route::group(['middleware' => 'admin'], function() {

    Route::get('/admin', [HomeController::class, 'index'])->name('admin.dashboard');
    Route::post('/admin/logout', [AuthenticatedSessionController::class, 'destroy'])->name('admin.logout');

    Route::get('/admin/password/change', [HomeController::class, 'password_change'])->name('admin.password.change');
    Route::post('/admin/password/update', [HomeController::class, 'password_update'])->name('admin.password.update');

    // __Notice routes
    Route::resource('/admin/notice', NoticeController::class);

    // __Routine routes
    Route::resource('/admin/routines_xi', RoutineXIController::class);
    Route::resource('/admin/routines_xii', RoutineXIIController::class);

    // __Student routes
    Route::resource('/admin/students', AllStudentsController::class);
    Route::resource('/admin/students_xi', XIStudentsController::class);
    Route::resource('/admin/students_xii', XIIStudentsController::class);
    Route::resource('/admin/students_old', OldStudentsController::class);
    Route::resource('/admin/hsc_examinee', HscExamineeController::class);
    Route::get('/admin/students/transfer-class/{id}', [AllStudentsController::class, 'transfer_class'])->name('students.transfer-class');

    //__HSC routes
    Route::resource('/admin/hsc', HscController::class);
    Route::get('/admin/hsc_prev', [HscController::class, 'index_prev'])->name('hsc.previous');

    //__Exam routes
    Route::post('/admin/students/exam/mt/update/{class}/{id}', [ExamController::class, 'update_mt'])->name('admin.students.exam.mt.update');
    Route::post('/admin/students/exam/hy/update/{class}/{id}', [ExamController::class, 'update_hy'])->name('admin.students.exam.hy.update');
    Route::post('/admin/students/exam/fnl/update/{class}/{id}', [ExamController::class, 'update_fnl'])->name('admin.students.exam.fnl.update');

    // __Teacher routes
    Route::resource('/admin/teachers', TeachersController::class);
    Route::get('/admin/teachers-science', [DeptTeachersController::class, 'science'])->name('admin.teachers-science');
    Route::get('/admin/teachers-Technologie', [DeptTeachersController::class, 'Technologie'])->name('admin.teachers-Technologie');
    Route::get('/admin/teachers-business', [DeptTeachersController::class, 'business'])->name('admin.teachers-business');

    // __Admission routes
    Route::resource('/admin/student/admission', AdmissionController::class);
    Route::resource('/admin/admission/security_code', SecurityCodeController::class);
    Route::get('/admin/admission/confirmation/{id}', [AdmissionController::class, 'confirmation'])->name('admin.admission.confirmation');

    // __Download routes
    Route::get('/admin/students/idcard/generate/{id}', [IDcardController::class, 'generate'])->name('admin.students.idcard.generate');
    Route::get('/admin/teachers/idcard/generate/{id}', [IDcardController::class, 'teachers_id_generate'])->name('admin.teachers.idcard.generate');

    Route::get('/admin/download/testimonial', [TestimonialController::class, 'index'])->name('admin.download.testimonial');
    Route::post('/admin/download/testimonial/generate', [TestimonialController::class, 'generate'])->name('admin.download.testimonial.generate');

    Route::get('/admin/download/tc', [TransCertController::class, 'index'])->name('admin.download.tc');
    Route::post('/admin/download/tc/generate', [TransCertController::class, 'generate'])->name('admin.download.tc.generate');




    //__Library routes

    Route::get('admin/dashboard_lib', [LibraryController::class , "dashboard"])->name('admin.dashboard_lib');
    Route::get('/admin/hsc_prev', [HscController::class, 'index_prev'])->name('hsc.previous');
    Route::get('admin/remove-book',[LibraryController::class, 'remove_book'])->name('admin.remove-book');
    Route::get('admin/book/delete/{id}',[LibraryController::class , "remove_book_process"])->name('admin.book.delete');
    Route::get('admin/add-book',[LibraryController::class , "add_book"])->name('admin.add-book');
    Route::post('admin/add-book/process',[LibraryController::class , "add_book_process"])->name('admin.add-book.process');
    Route::get('admin/update-book',[LibraryController::class , "update_book"])->name('admin.update-book');
    Route::get('admin/book/edit/{id}',[LibraryController::class , "edit_book"])->name('admin.book.edit');
    Route::post('admin/edit-book/process/{id}',[LibraryController::class , "edit_book_process"])->name('admin.edit-book.process');
    Route::get('admin/student-request',[LibraryController::class , "student_request"])->name('admin.student-request');
    Route::get('student/approve/{id}',[LibraryController::class , "student_approve"])->name('admin.student.approve');
    Route::get('student/reject/{id}',[LibraryController::class , "student_reject"])->name('admin.student.reject');
    Route::get('admin/book-order',[LibraryController::class , "book_order"])->name('admin.book-order');
    Route::get('admin/add-order',[LibraryController::class , "add_order"])->name('admin.add_order');
    Route::get('admin/book-received',[LibraryController::class , "book_received"])->name('admin.book-received');
    Route::get('admin/book-received/process/{id}',[LibraryController::class , "book_received_process"])->name('admin.book-received.process');
    Route::post('admin/add-order/process',[LibraryController::class , "add_order_process"])->name('admin.add-order.process');

    Route::get('admin/shelf-list',[LibraryController::class , "shelf_list"])->name('admin.shelf-list');

    Route::get('admin/book-list/programming/',[LibraryController::class , "programming_book"])->name('admin.book-list.programming');
    Route::get('admin/book-list/networking/',[LibraryController::class , "networking_book"])->name('admin.book-list.networking');
    Route::get('admin/book-list/database/',[LibraryController::class , "database_book"])->name('admin.book-list.database');
    Route::get('admin/book-list/electronics/',[LibraryController::class , "electronics_book"])->name('admin.book-list.electronics');
    Route::get('admin/book-list/software-development/',[LibraryController::class , "software_book"])->name('admin.book-list.software-development');

    Route::get('admin/add-shelf',[LibraryController::class , "add_shelf"])->name('admin.add-shelf');
    Route::post('admin/add-shelf/process',[LibraryController::class , "add_shelf_process"])->name('admin.add-shelf.process');
    Route::get('admin/update-shelf',[LibraryController::class , "update_shelf"])->name('admin.update-shelf');
    Route::get('admin/shelf/edit/{id}',[LibraryController::class , "edit_shelf"])->name('admin.shelf.edit');
    Route::post('admin/edit-shelf/process/{id}',[LibraryController::class , "edit_shelf_process"])->name('admin.edit-shelf.process');
    Route::get('admin/remove-shelf',[LibraryController::class , "remove_shelf"])->name('admin.remove-shelf');
    Route::get('admin/shelf/delete/{id}',[LibraryController::class , "remove_shelf_process"])->name('admin.shelf.delete');
    Route::get('admin/book/details/{id}',[LibraryController::class , "book_details"])->name('admin.book.details');
    Route::get('admin/shelf/details/{id}',[LibraryController::class , "shelf_details"])->name('admin.shelf.details');
    Route::get('admin/notification',[LibraryController::class , "notification"])->name('admin.notification');
    //  [LibraryController::class , "add_book"]

});
