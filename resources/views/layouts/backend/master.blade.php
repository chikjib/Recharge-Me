<!DOCTYPE html>
<html lang="en">
<head>
<title>{{ config('app.name') }} - @if(Auth::user()->role == 2) Admin @else Dashboard @endif</title>
<meta charset="UTF-8" />
<meta name="csrf-token" content="{{ csrf_token() }}">

<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" />
<link rel="stylesheet" href="{{ asset('css/bootstrap-responsive.min.css') }}" />
<link rel="stylesheet" href="{{ asset('css/fullcalendar.css') }}" />
<link rel="stylesheet" href="{{ asset('css/matrix-style.css') }}" />
<link rel="stylesheet" href="{{ asset('css/matrix-media.css') }}" />
<link rel="stylesheet" href="{{ asset('css/colorpicker.css') }}" />
<link rel="stylesheet" href="{{ asset('css/datepicker.css') }}" />
<link rel="stylesheet" href="{{ asset('css/uniform.css') }}" />
<link rel="stylesheet" href="{{ asset('css/select2.css') }}" />

<link href="{{ asset('font-awesome/css/font-awesome.css') }}" rel="stylesheet" />
<link rel="stylesheet" href="{{ asset('css/jquery.gritter.css') }}" />
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>
<script src="{{ asset('js/cufon-yui.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/cufon-replace.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/FF-cash.js') }}" type="text/javascript"></script>	  
<script src="{{ asset('js/jquery.easing.1.3.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/matrix.popover.js') }}"></script> 
<script src="{{ asset('js/jquery.min.js') }}"></script> 
<script src="//cdn.ckeditor.com/4.15.0/standard/ckeditor.js"></script>

</head>
<body>

@include('layouts.backend.header')
@include('layouts.backend.sidebar')
@yield('content')
@include('layouts.backend.footer')