@extends('admin.layouts.app')

@section('content')

{{-- lezmin hedhom e zouz !!!!!!!!!!!!!!! --}}
<?php $menu = 'Library_Dashboard'; ?>
<?php $submenu = 'book_received'; ?>






<!DOCTYPE html>
<!-- Created By CodingNepal -->
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <!-- Somehow I got an error, so I comment the title, just uncomment to show -->
    <!-- <title>Sidebar Menu with sub-menu | CodingNepal</title> -->
    <title>Book Received</title>



<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet">

<link href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css" rel="stylesheet">

<!-- Bootstrap core JavaScript-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<!-- Page level plugin JavaScript--><script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>

<script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>

{{-- <link rel="stylesheet" href="{{ asset('css/style7.css') }}">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script> --}}

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

 
</ul>
</nav>

    <div class="content" style="margin-left:310px;padding-top:110px;padding-right:50px;width:80%;">


    <div class="container">
    <h1 style="margin-top:-50px; padding-left:320px; padding-bottom:50px">Book Receive</h1>

    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>Serial</th>
                <th>Student ID</th>

                <th>Book ID</th>
                <th>Book Name</th>
                <th>Collection Date</th>
                <th>Expired Date</th>
                <th>Submission Status</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
        <?php
             $count=1;
             ?>
            @foreach($book_order as $row)


            <tr>
            <td>{{ $count }}</td>
                <td>{{$row->Student_ID }}</td>
                <?php


                    $student=DB::table('students')->where('Verify','Approve')->where('Student_ID',$row->Student_ID)->first();

                    $book=DB::table('books')->where('Book_ID',$row->Book_ID)->first();


                ?>



                <td>{{ $row->Book_ID }}</td>
                <td>{{ $book->Book_Name }}</td>
                <td>{{ $row->Collection_Date }}</td>
                <td>{{ $row->Expired_Date }}</td>
                <td>{{ $row->Submission_Status }}</td>
                <td>

                    <a href="{{ url('admin/book-received/process/'.$row->id) }}" class="btn btn-success">Receive</a>

                </td>

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

function loadDoc() {


        setInterval(function(){

        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
            document.getElementById("notify_number").innerHTML = this.responseText;
            }
        };
        xhttp.open("GET", "{{ Url('admin/notify/count/') }}", true);
        xhttp.send();

        },9000);


}
loadDoc();


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

  </body>
</html>
@endsection
