@extends('layouts.app')
@section('title')
    Dorms |


@endsection
@php
$menu = 'dorms';
$rightbarImage = 'st_over_book.png';
@endphp


@section('content')
    <div class="row">
        {{-- Left section started --}}
        <div class="d-none d-lg-block col-lg-3 py-md-4 scroll">

            @include('layouts.includes.leftbar')
        </div>
        {{-- Left section ended --}}


        {{-- Center section started --}}
        <div class="col-lg-6 col-md-8 pt-4 py-md-4 scroll justify-content-center d-flex">
            <div class="col-lg-11">
                <a href="{{ route('student.dashboard') }}">dashboard</a>
            </div>
        </div>

        {{-- Center section ended --}}


        {{-- Right section starts --}}
        <div class="col-lg-3 col-md-4 py-md-4 pt-4 scroll">

            @include('layouts.includes.rightbar')

        </div>
        {{-- Right section ended --}}

    </div>
@endsection
