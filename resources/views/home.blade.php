<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
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
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <!-- <link rel="stylesheet" href="{{URL::asset('backend/css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{URL::asset('backend/css/bootstrap.min.css')}}">
    <script src="{{ URL::asset('backend/js/bootstrap.js') }}"></script>
    <script src="{{ URL::asset('backend/js/bootstrap.min.js') }}"></script>   -->

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.js"></script>

    <!-- Bootstrap Import Css And Js -->
</head>

<body onFocus="parent_disable();" onclick="parent_disable();">
    <nav class="navbar navbar-expand-lg navbar-light" style="background-color:#316698;">
        <!-- for logo -->
        <a class="navbar-brand p-0 m-0" href="{{ url('/') }}"><input type="image" title="Logo"
                src="{{ asset('/backend/images/logo.png') }}" height="80" width="80" /></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto" style="font-size:20px;">
                <li class="ml-4 nav-item active">
                    <a class="nav-link border p-1" aria-label="Levels" style="color:white;"
                        href="{{ url('/') }}">Home</a>
                </li>

                <li class="ml-4  nav-item active">
                    <a class="nav-link border p-1" title="Hello" aria-label="Home" style="color:white;"
                        href="{{ url('/searchall') }}">Search</a>
                </li>

                <li class="ml-4 nav-item active">
                    <a class="nav-link border p-1" aria-label="Statistics" style="color:white;"
                        href="{{ url('statistics') }}">Statistics</a>
                </li>

                <!-- <li class="nav-item active">
                    <a class="nav-link " href="{{ url('/semesters') }}">Semesters/Year</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link active" href="{{ url('/subjects') }}">Subjects</a>
                </li> -->
            </ul>

            <form class="form-inline my-2 ml-2 my-lg-0">
                <a style="float:right;color:white;text-decoration:none;" class="mt-2" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"><input type="image" title="Logo"
                src="{{ asset('/backend/images/logout.jpg') }}" height="40" width="80" /></a>
            </form>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
    </nav>
    @yield('content')
</body>

</html>
