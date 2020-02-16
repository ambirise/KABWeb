<nav class="navbar navbar-expand-lg navbar-light" style="background-color:#316698;">
        <!-- for logo -->
        <a class="navbar-brand" href="#"><input type="image" id="myimage" src="{{ asset('/backend/images/logo.jpeg') }}"
                height="40" width="80" /></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto" style="font-size:20px;">

                <li class="ml-2 nav-item active" >
                    <a class="nav-link border p-1" style="color:white;" href="{{ url('/home') }}">Home</a>
                </li>
                <li class="ml-2 nav-item active">
                    <a class="nav-link border p-1" style="color:white;" href="{{ url('/levels') }}">Levels</a>
                </li>
                <!-- <li class="nav-item active">
                    <a class="nav-link" href="{{ url('faculties') }}">Faculties</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link " href="{{ url('/semesters') }}">Semesters/Year</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link active" href="{{ url('/subjects') }}">Subjects</a>
                </li> -->
            </ul>
            <form class="form-inline my-2 ml-2 my-lg-0">
                <a style="float:right;color:white;text-decoration:none;" class="mt-2" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"><span
                        style="font-size:20px;" class="border p-1">Logout</span></a>
            </form>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
    </nav>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.js"></script>

<style>
    .progress {
        position: relative;
        width: 100%;
    }

    .bar {
        background-color: #008000;
        width: 0%;
        height: 20px;
    }

    .percent {
        position: absolute;
        display: inline-block;
        left: 50%;
        color: #7F98B2;
    }

</style>


<br>
<div class="container">
    <a href="{{ url('/levels') }}"><span>Levels</span></a> -> <a
        href="{{ url('/faculties',$get_chapter_data->level_id) }}"><span>{{$level_title->level_title}}</span></a>
    <!-- -> <a href="{{ url('/semesters',$get_chapter_data->faculty_id) }}"><span>Semesters</span></a> -->
    -> <a href="{{ url('/subjects',$get_chapter_data->faculty_id) }}"><span>{{$get_faculty_title->faculty_title}}</span></a>
    -> <a href="{{ url('/chapters',$get_chapter_data->subject_id) }}"><span>{{$get_subject_title->subject_title}}</span></a>
    -> <a href="{{ url('/contents',$get_chapter_data->chapter_id) }}"><span>{{$get_chapter_data->chapter_title}}</span></a>
    <div class="card mt-4 addcontentform" hidden="true">
        <div class="card-body">
            <form action="{{ route('contentsStore',$get_chapter_data->chapter_id) }}" method="POST"
                enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Upload Audio:</label>
                            <input multiple="multiple" type="file" name="audio[]" required>
                            <div class="progress">
                                <div class="bar"></div>
                                <div class="percent">0%</div>
                            </div><br>
                        </div>
                    </div>
                    <div class="col-md-6"><br>
                        <input type="hidden" name="_token" value="{{ csrf_token()}}">
                        <button type="submit" class="btn btn-default"> Add </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@if($message = Session::get('violation'))
<div class="container mt-2">
    <div class="card alert alert-danger" role="alert">
        <p>{{$message}}<p>
    </div>
</div>
@endif

@if($message = Session::get('searchnotfound'))
        <div class="container mt-2">
            <div class="alert alert-danger" role="alert">
                <p>{{$message}}<p>
            </div>
        </div>
@endif

<div class="container">
    <div class="card mt-2">
        <div class="card-header text-center">
            <div class="row">
                <div class="col-md-8">
                    <form action="{{route('getcontentsSearch',$get_chapter_data->chapter_id)}}" method="POST" role="search">
                        {{ csrf_field() }}
                        <div class="input-group" class="columnpatient1">
                            <input type="text" class="form-control" name="q" placeholder="Search">
                            <span class="input-group-btn">
                                <button type="submit" class="btn btn-secondary">
                                    Search
                                </button>
                            </span>
                        </div>
                    </form>
                </div>
                <div class="col-md-4">
                    <!-- // for other additional pages -->
                    <button class="btn btn-outline-primary" id="addcontentbutton" style="float:right">ADD</button>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table class="table mt-0 table-striped">
                <thead>
                    <tr>
                        <th scope="col">S.N</th>
                        <th scope="col">Name</th>
                        <th scope="col">Audio</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($get_content_data_array as $key=>$content_data)
                    <tr onclick="window.location = '{{route('getcontentShow',$content_data->content_id)}}'"
                        style="cursor:pointer;">
                        <td>{{$key+1}}</td>
                        <td>{{$content_data->content_type}}</td>
                        <td>{{$content_data->content_title}}</td>
                        <td>
                            <a><button class="btn btn-primary">Edit</button></a>
                            <a href="{{route('delcontentsDetails',$content_data->content_id)}}" onclick="return confirm('Are you sure?')" class="delete_user"><button
                                    type="button" class="btn btn-danger ">Delete</button></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- <script type="text/javascript">
    $(function () {
        $(document).ready(function () {
            var bar = $('.bar');
            var percent = $('.percent');

            $('form').ajaxForm({
                beforeSend: function () {
                    var percentVal = '0%';
                    bar.width(percentVal)
                    percent.html(percentVal);
                },
                uploadProgress: function (event, position, total, percentComplete) {
                    var percentVal = percentComplete + '%';
                    bar.width(percentVal)
                    percent.html(percentVal);
                },
                complete: function (xhr) {
                    alert('File Uploaded Successfully');
                    window.location.href = '{{route('getcontentsIndex',$get_chapter_data->chapter_id)}}';
                }
            });
        });
    });

</script> -->

<script>
        $("#addcontentbutton").click(function () {
            $('.addcontentform').removeAttr("hidden");
        });

</script>
