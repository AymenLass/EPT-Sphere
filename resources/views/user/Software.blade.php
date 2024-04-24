@extends('layouts.app')
@section('title')
Programming Books
@endsection
@php
$menu = 'Home';
$rightbarImage = 'study_chat.png';
@endphp


@section('content')
    <div class="row">
        {{-- Left section started --}}
        <div class="d-none d-lg-block col-lg-3 py-md-4 scroll">
            @include('layouts.includes.leftbar2')
        </div>
        {{-- Left section ended --}}


        {{-- Center section started --}}
        <div class="col-lg-6 col-md-8 py-md-4 pt-4  justify-content-center d-flex">
            <div class="col-lg-11 pb-4">




<!DOCTYPE html>
<!-- Created By CodingNepal -->
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <!-- Somehow I got an error, so I comment the title, just uncomment to show -->
    <!-- <title>Sidebar Menu with sub-menu | CodingNepal</title> -->
    <title>Programming Books</title>



<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet">

<link href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css" rel="stylesheet">

<!-- Bootstrap core JavaScript-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<!-- Page level plugin JavaScript--><script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>

<script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.css">
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

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
		var type="{{Session::get('alert-type','info')}}"

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

<div style=display:inline-flex>

<nav class="sidebar">
    <div class="user-info" style="display:inline-flex;margin:10px 10px 10px 10px">
            <div class="profile" style="padding: 15px 15px 15px 45px;">
            @foreach($user as $row)

              <img src="{{ asset($row->Image) }}" style="width:80px; height:80px; border-radius:50%;" alt="">
            </div>
            <div class="details" style="margin-top:25px">
              <p class="user-name" style="color:; margin-left:10px; font-size:20px;font-family: 'Pacifico', cursive;" >{{ $row->Name }}</p>
              @endforeach
            </div>
    </div>

</nav>

    <div class="content" style="margin-left:310px;padding-top:120px; padding-right:50px;width:80%;">

              <h1 style="margin-top:-50px; padding-left:280px; padding-bottom:50px">Programming Book</h1>


    <div class="container">

    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>Serial</th>
                <th>Book ID</th>
                <th>Book Name</th>
                <th>Writer Name</th>
                <th>Available (Shelf)</th>
                <th>Available (Students)</th>
                <th>Shelf ID</th>
                <th>Shelf Location</th>

            </tr>
        </thead>

        <tbody>
        <?php
             $count=1;
             ?>
            @foreach($book as $row)


            <tr>
            <td>{{ $count }}</td>
                <td>{{$row->Book_ID }}</td>
                <?php


                    $shelf_copy=DB::table('books')->where('Book_ID',$row->Book_ID)->first();

                    $student_copy=DB::table('records')->where('Book_ID',$row->Book_ID)
                    ->where('Submission_Status','No')->count();


                    $shelf=DB::table('shelfs')->where('Shelf_ID',$row->Shelf_ID)
                    ->first();


                ?>



                <td>{{ $row->Book_Name }}</td>
                <td>{{ $row->Writer_Name }}</td>
                <td>{{ $shelf_copy->Amounts }}</td>
                <td>{{ $student_copy }}</td>
                <td>{{ $row->Shelf_ID }}</td>
                <td>{{ $shelf->Shelf_Location }}</td>



            </tr>
            <?php

                $count++;

            ?>
            @endforeach
        </tbody>
    </table>
</div>


    </div>
</div>

    <script>

   $(document).ready( function () {
  var table = $('#dataTable').DataTable( {

    pageLength : 5,
    lengthMenu: [[5, 10, 20, -1], [5, 10, 20, 'All']]
  } )
} );

</script>
<script>

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
    </script>


<script type="text/javascript">
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

                },3000);


        }
        loadDoc();


</script>

  </body>
</html>



                {{-- pagination --}}
                {{-- @foreach ($peoples as $people) --}}
            </div>
        </div>
        {{-- Center section ended --}}




    </div>
@endsection

