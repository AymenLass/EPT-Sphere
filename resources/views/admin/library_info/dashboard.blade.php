@extends('admin.layouts.app')

@section('content')

{{-- lezmin hedhom e zouz !!!!!!!!!!!!!!! --}}
<?php $menu = 'Library_Dashboard'; ?>
<?php $submenu = ''; ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">

    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet">

    <!-- DataTables CSS -->
    <link href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css" rel="stylesheet">

    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <!-- DataTables JavaScript -->
    <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>

    <!-- Toastr JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js"></script>
    <!-- Toastr CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.css">

    <!-- SweetAlert JavaScript -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <!-- Multilevel Dropdown CSS -->
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


    <style>

      .parent_card{


          display:inline-flex;
          margin-top:20px;


      }
      .card_special{


          box-shadow: 5px 8px #888888;
          border:2px solid black;
          margin-left:50px;
          margin-top:10px;
          padding: 20px 0px 0px 0px;
          border-radius:15px;
          width:450px;
          height:250px;



      }
      .card_special:hover{

        background:orange;
        border: 3px solid green;
        transform: rotate(5deg);
        transition-duration: 0.5s;


      }
      .card_special h5{


        padding:10px 20px 0px 20px;


      }
      .card_special h2{

        padding:10px 20px 15px 20px;


      }
      .card_special img{


        width:100%;
        border-radius:15px;



      }
      .intro{

        text-align:center;


      }
      .intro .profile_section{



      }
      .intro img{

        width:150px;
        height:150px;
        border-radius:50%;
        border: 10px solid blue;
        background:transparent;
        margin-bottom:20px;

      }
      .into .name{



      }
      .inro .roll{



      }
      .intro .section{


        margin-bottom:50px;


      }



</style>







<div class="content" style="margin-left:310px; padding-top:0px; padding-right:50px; width:80%;">

    <div class="parent_card">

        <div class="card_special">

          <h5>Total Student</h5>
          <h2>{{ $total_student }}</h2>


          {{-- <img src="{{ asset('image/Card_graph2.png') }}" alt=""> --}}


        </div>
        <div class="card_special">

        <h5>Total Book (Shelf)</h5>
        <h2>{{ $total_book }}</h2>


        {{-- <img src="{{ asset('image/Card_graph3.png') }}" alt=""> --}}


        </div>

    </div>
    <div class="parent_card">

        <div class="card_special">

          <h5>Total Shelf</h5>
          <h2>{{ $total_shelf }}</h2>


          <img src="{{ asset('image/Card_graph4.png') }}" alt="">


        </div>
        <div class="card_special">

        <h5>Book Order (Not Submitted)</h5>
        <h2>{{ $total_order }}</h2>


        <img src="{{ asset('image/Card_graph5.png') }}" alt="">


        </div>
        </div>

        <br>
        <br>
        <br>
        <br>
        <br>
        <h3 style="margin-left:50px;">Recent Order</h3>
        <table class="table table-striped" style="width:90%;margin-left:50px; ">
  <thead>
    <tr>
      <th scope="col">Serial</th>
      <th scope="col">Student ID</th>
      <th scope="col">Book ID</th>
      <th scope="col">Collection Date</th>
    </tr>
  </thead>
  <?php

    $count=1;

  ?>
  @foreach($records as $row)

  <tbody>
    <tr>
      <th scope="row">{{ $count }}</th>
      <td>{{ $row->Student_ID }}</td>
      <td>{{ $row->Book_ID }}</td>
      <td>{{ $row->Collection_Date }}</td>

    </tr>

  </tbody>

  <?php

    $count++;


  ?>

  @endforeach

</table>
<br><br>
<br>





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
                    document.getElementById("notify_number").innerHTML = this.responseText;
                    }
                };
                xhttp.open("GET", "{{ Url('admin/notify/count/') }}", true);
                xhttp.send();

                },1000);


        }
        loadDoc();


</script>

  </body>
</html>

@endsection
