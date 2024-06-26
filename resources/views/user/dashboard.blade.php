<!DOCTYPE html>
<!-- Created By CodingNepal -->
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Student Dashboard</title>
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    {{-- <link rel="stylesheet" href="{{ asset('css/style7.css') }}"> --}}
    {{-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.css"> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="css/multilevel-dropdown.css">
  </head>
  <body>
    <script>
    @if(Session::has('mess'))
        swal("Congrats!", "Successfully Approved !", "success");
    @endif

    @if(Session::has('mess2'))
        swal("Congrats!", "Successfully Rejected !", "success");
    @endif

    @if(Session::has('message'))
        var type="{{Session::get('alert-type','info')}}";
        switch(type){
            case 'info':
                toastr.info("{{ Session::get('message') }}");
                break;
            case 'success':
                toastr.success("{{ Session::get('message') }}");
                break;
            case 'warning':
                toastr.warning("{{ Session::get('message') }}");
                break;
            case 'error':
                toastr.error("{{ Session::get('message') }}");
                break;
        }
    @endif

    $('.datepicker').datepicker({
        startDate: new Date()
    });
    </script>

    <div style="display:inline-flex">
        <nav class="sidebar">
            <div class="user-info" style="display:inline-flex;margin:10px 10px 10px 10px">
                <div class="profile" style="padding: 15px 15px 15px 45px;">
                    @foreach($user as $row)
                    <img src="{{ asset('images/users/' . $row->user_image) }}" style="width:80px; height:80px; border-radius:50%;" alt="">
                </div>
                <div class="details" style="margin-top:25px">
                    <p class="user-name" style="color:; margin-left:10px; font-size:20px;font-family: 'Pacifico', cursive;">{{ $row->name }}</p>
                    @endforeach
                </div>
            </div>
            <ul>
                <li class="active"><a href="{{ url('student/dashboard') }}"><i class="fas fa-tachometer-alt" style="margin-left: -10px;font-size:15px;"></i>&nbsp;&nbsp;Dashboard</a></li>
                <li><a href="{{ url('student/notification') }}"><i class="fas fa-bell" style="margin-left: -10px; font-size:15px;"></i>&nbsp;&nbsp;&nbsp;Notification</a>
                    <span class="count" style="border-radius:50%; height:25px;width:25px;text-align:center; font-size:20px; border:none;margin-right:80px; padding-bottom:80px;color:yellow;"  id="student_notify_number"></span>
                </li>
                <li>
                    <a href="#" class="feat-btn"><i class="fas fa-book-open" style="margin-left: -10px;font-size:13px;"></i>&nbsp;&nbsp;&nbsp;Book List
                        <span class="fas fa-caret-down first"></span>
                    </a>
                    <ul class="feat-show">
                        <li><a href="{{ url('student/book-list/programming') }}">Programming</a></li>
                        <li><a href="{{ url('student/book-list/networking') }}">Networking</a></li>
                        <li><a href="{{ url('student/book-list/database') }}">Database</a></li>
                        <li><a href="{{ url('student/book-list/electronics') }}">Electronics</a></li>
                        <li><a href="{{ url('student/book-list/software-development') }}">Software Development</a></li>
                    </ul>
                </li>


                <li><a href="{{ url('student/shelf-list') }}"><i class="fas fa-book" style="margin-left: -10px; font-size:15px;"></i>&nbsp;&nbsp;&nbsp;Shelf List</a></li>
                <li><a href="{{ url('student/my-collection') }}"><i class="fas fa-book" style="margin-left: -10px; font-size:15px;"></i>&nbsp;&nbsp;&nbsp;My Collection</a></li>
                <li><a href="{{ url('student/my-submission') }}"><i class="fas fa-book" style="margin-left: -10px; font-size:15px;"></i>&nbsp;&nbsp;My Submission</a></li>
                {{-- <li>
                    <a href="#" class="serv-btn"><i class="fas fa-cog" style="margin-left: -10px;font-size:15px;"></i>&nbsp;&nbsp;&nbsp;Settings
                        <span class="fas fa-caret-down second"></span>
                    </a>
                    <ul class="serv-show">
                        <li><a href="{{ url('student/edit-info') }}">Edit Info</a></li>
                        <li><a href="{{ url('student/change-password') }}">Change Password</a></li>
                    </ul>
                </li>
                <li><a href="{{ url('student/log-out') }}"><i class="fas fa-sign-out-alt" style="margin-left: -10px; font-size:15px;"></i>&nbsp;&nbsp;&nbsp;Log out</a></li> --}}
            </ul>
        </nav>

        <div class="content" style="margin-left:310px;padding-top:90px; padding-right:50px;width:80%;">
            @foreach($user as $row)
            <div class="container">
                <div class="row">
                    <div class="panel panel-default" style="width:90%;margin-left:50px;">
                        <div class="panel-heading"><h4>User Dashboard</h4></div>
                        <div class="panel-body">
                            <div class="col-md-4 col-xs-12 col-sm-6 col-lg-4">
                                <img alt="User Pic" src="{{ asset('images/students/' . $row->user_image) }}" id="profile-image1" class="img-circle img-responsive" style="width:300px;height:300px; border:2px solid blue;">
                            </div>
                            <div class="col-md-8 col-xs-12 col-sm-6 col-lg-8">
                                <div class="container">
                                    <br>
                                    <h1 style=""><i>{{ $row->name }}</i></h1>
                                    <h2> Student ID : {{ $row->id }}</h2>
                                    {{-- <h2> Session : {{ $row->session }}</h2> --}}
                                </div>
                                <hr>
                                <?php
                                    $records=DB::table('records')->where('Student_ID',$row->id)
                                    ->where('Submission_Status','No')
                                    ->count();
                                ?>
                                <h3 style="margin-left:20px;">Status : Active</h3>
                                <h3 style="margin-left:20px;">My Collection : {{ $records }} Books</h3>
                                <hr>
                                <br>
                                <h3><i class="fas fa-envelope icon_style"></i>Email : {{ $row->email }}</h3>
                                {{-- <h3><i class="fas fa-phone-alt icon_style"></i>Contact : {{ $row->phone }}</h3> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <script>
        $(document).ready(function () {
            var table = $('#dataTable').DataTable({
                pageLength: 5,
                lengthMenu: [[5, 10, 20, -1], [5, 10, 20, 'All']]
            });
        });

        $('.feat-btn').click(function(){
            $('nav ul .feat-show').toggleClass("show5");
            $('nav ul .first').toggleClass("rotate");
        });

        $('.extra-btn').click(function(){
            $('nav ul .extra-show').toggleClass("show2");
            $('nav ul .third').toggleClass("rotate");
        });

        $('.serv-btn').click(function(){
            $('nav ul .serv-show').toggleClass("show1");
            $('nav ul .second').toggleClass("rotate");
        });

        $('.shelf-btn').click(function(){
            $('nav ul .shelf-show').toggleClass("show3");
            $('nav ul .fourth').toggleClass("rotate");
        });

        $('nav ul li').click(function(){
            $(this).addClass("active").siblings().removeClass("active");
        });

        function loadDoc() {
            setInterval(function(){
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById("student_notify_number").innerHTML = this.responseText;
                    }
                };
                xhttp.open("GET", "{{ Url('student/notify/count/') }}", true);
                xhttp.send();
            }, 3000);
        }
        loadDoc();
    </script>
  </body>
</html>



