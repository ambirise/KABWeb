<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Audio Library</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{URL::asset('backend/css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{URL::asset('backend/css/bootstrap.min.css')}}">
    <script src="{{ URL::asset('backend/js/bootstrap.js') }}"></script>
    <script src="{{ URL::asset('backend/js/bootstrap.min.js') }}"></script>   
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> 

    <!-- Bootstrap Import Css And Js -->

</head> 
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#"><input type="image" id="myimage" src="{{ asset('/backend/images/logo.jpeg') }}"
                height="40" width="80" /></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto" style="font-size:20px;">
                <li class="nav-item active">
                    <a class="nav-link" href="{{ url('/home') }}">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="{{ url('/levels') }}">Levels</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="{{ url('faculties') }}">Faculties</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link " href="{{ url('/semesters') }}">Semesters/Year</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link active" href="{{ url('/subjects') }}">Subjects</a>
                </li>
            </ul>
            <form class="form-inline my-2 my-lg-0">
                <a style="float:right;color:white;text-decoration:none;" class="mt-2" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"><span style="font-size:20px;color:white;"><u>Logout</u></span></a>
            </form>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
    </nav>
    @yield('content')
</body>

</html>
