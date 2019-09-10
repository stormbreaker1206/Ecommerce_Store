@extends('layouts.base')
@section('body')

    <!-- Navigation -->
    @include('includes.nav')
    <!-- Navigation -->

    <!-- Site Wrapper -->

    <div class="site_wrapper">

        @yield('content')

        <div class="notify text-center"></div>
    </div>
    <!-- Site Wrapper -->

    @yield('footer')

@stop
