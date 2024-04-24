@extends('admin.layouts.app')

@section('content')

{{-- lezmin hedhom e zouz !!!!!!!!!!!!!!! --}}
<?php $menu = 'Library_Dashboard'; ?>
<?php $submenu = 'add_book'; ?>




<!DOCTYPE html>
<!-- Created By CodingNepal -->
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <!-- Somehow I got an error, so I comment the title, just uncomment to show -->
    <!-- <title>Sidebar Menu with sub-menu | CodingNepal</title> -->
    <title>Add Book</title>



<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet">

<link href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css" rel="stylesheet">

<!-- Bootstrap core JavaScript-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<!-- Page level plugin JavaScript--><script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>

<script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>

<link rel="stylesheet" href="{{ asset('css/style5.css') }}">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>

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

    <div class="content" style="margin-left:400px;margin-top:10px;padding:30px 30px 30px 30px;width:50%; text-align:left; border: 2px solid blue; border-radius:25px">

    <h1 style="padding-bottom:20px; color:blue"> Add Book </h1>
    <form method="post" action="{{ url('admin/add-book/process') }}" class="action_form">

        @csrf
        <div class="form-group">
            <label for="exampleInputEmail1">Book ID</label>
            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Book ID" name="book_id" required>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Book Name</label>
            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Book Name" name="book_name" required>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Writer Name</label>
            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Writer Name" name="writer_name" required>
        </div>
        <div class="form-group">
        <label for="exampleFormControlSelect1">Catagory</label>
        <select class="form-control" id="exampleFormControlSelect1" name="catagory">
            <option value="Programming">Programming</option>
            <option value="Networking">Networking</option>
            <option value="Database">Database</option>
            <option value="Electronics">Electronics</option>
            <option value="Software Development">Software Development</option>

        </select>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Amounts</label>
            <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Book Amounts" name="amounts" required>
        </div>
        <div class="form-group">
        <label for="exampleFormControlSelect1">Shelf ID</label>
        <select class="form-control" id="exampleFormControlSelect1" name="shelf_id">

            @foreach($shelf as $row)
            <option value="{{ $row->Shelf_ID }}">{{ $row->Shelf_ID }}</option>
            @endforeach

        </select>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>

    </form>


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

        },3000);


}
loadDoc();

    </script>



  </body>
</html>
@endsection
