<!DOCTYPE html>
<html>
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        @yield('title')
        | {{ config('app.name') }}
        
    </title>
    <!--global css starts-->
    <link rel="stylesheet" type="text/css" href="{{ asset('front/css/lib.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('front/css/frontend/custom1.css') }}">
    <!--end of global css-->
    <!--page level css-->
    <!--page level css starts-->
<link rel="stylesheet" type="text/css" href="{{ asset('front/css/frontend/tabbular.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('front/vendors/animate/animate.min.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ asset('front/css/frontend/jquery.circliful.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('front/vendors/owl_carousel/css/owl.carousel.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('front/vendors/owl_carousel/css/owl.theme.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('front/css/frontend/index.css') }}">
<!--end of page level css-->
    <!--end of page level css-->
</head>
@include('layouts.frontend.header')
@yield('content')
@include('layouts.frontend.footer')
