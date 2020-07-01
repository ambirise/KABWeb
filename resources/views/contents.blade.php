<nav class="navbar navbar-expand-lg navbar-light" style="background-color:#316698;">
        <!-- for logo -->
        <a class="navbar-brand p-0 m-0" href="{{ url('/') }}"><input type="image" id="myimage" src="{{ asset('/backend/images/logo.png') }}"
                height="80" width="80" /></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto" style="font-size:20px;">
            <li class="ml-5 nav-item active">
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
                                                     document.getElementById('logout-form').submit();"><span
                        style="font-size:20px;">Log Out</span></a>
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
    <a href="{{ url('/') }}"><span>Levels</span></a> -> <a
        href="{{ url('/faculties',$get_subject_data->level_id) }}"><span>{{$level_title->level_title}}</span></a>

    -> <a
        href="{{ url('/subjects',$get_subject_data->faculty_id) }}"><span>{{$get_faculty_title->faculty_title}}</span></a>
    -> <a
        href="{{ url('/chapters',$get_subject_data->subject_id) }}"><span>{{$get_subject_title->subject_title}}</span></a>

    <div class="card mt-4 addbookform" hidden="true">
        <div class="card-body">
            <form action="{{ route('contentsStore',$get_subject_data->subject_id) }}" id="bookSubmit" method="POST"
                enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-5">
                        <div class="form-group">
                            <label class="border border-black p-1">Upload Book:</label>
                            <input multiple="multiple" type="file" id="audiofile" name="audio[]" webkitdirectory directory multiple/>
                            <div class="progress">
                                <div class="bar"></div>
                                <div class="percent">0%</div>
                            </div><br>
                        </div>
                    </div>
                    <div style="border-left: 6px; height: auto;color:"></div>
                    <div class="col-md-6"><br>
                        <input type="hidden" name="_token" value="{{ csrf_token()}}">
                        <button type="submit" class="btn btn-outline-primary"> Add </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="card mt-4 addcontentform" hidden="true">
        <div class="card-body">
            <form action="{{ route('contentsStore',$get_subject_data->subject_id) }}" id="contentSubmit" method="POST"
                enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-5">
                        <div class="form-group">
                            <label class="border border-black p-1">Upload Audio:</label>
                            <input multiple="multiple" type="file" id="audiofile" name="audio[]" >
                            <div class="progress">
                                <div class="bar"></div>
                                <div class="percent">0%</div>
                            </div><br>
                        </div>
                    </div>
                    <div style="border-left: 6px; height: auto;color:"></div>
                    <div class="col-md-6"><br>
                        <input type="hidden" name="_token" value="{{ csrf_token()}}">
                        <button type="submit" class="btn btn-outline-primary"> Add </button>
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
                    <form action="" method="POST"
                        role="search">
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
                    <button class="btn btn-outline-primary" id="addbookbutton" style="float:right">Add Book
                        </button>
                    <button class="btn btn-outline-primary" id="addcontentbutton" style="float:left">Add Content
                        </button>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table class="table mt-0 table-striped">
                <thead>
                    <tr>
                        <th scope="col">S.N</th>
                        <th scope="col">Name</th>
                        <!-- <th scope="col">Audio</th> -->
                        <th scope="col"><span style="float:left">Action</span> <a href="{{route('delcontentsdetailsAll',$get_subject_data->subject_id)}}"
                                onclick="return confirm('Are you sure?')" class="delete_user"><button type="button"
                                    class="btn btn-danger" style="float:right">Delete All </button></a></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($get_content_data_array as $key=>$content_data)
                    <tr onclick="window.location = '{{route('getcontentShow',$content_data->content_id)}}'"
                        style="cursor:pointer;">
                        <td>{{$key+1}}</td>
                        <td>{{$content_data->content_name}}</td>
                        <!-- <td>{{$content_data->content_title}}</td> -->
                        <td>
                        <a href="{{route('editcontentsDetails',$content_data->content_id)}}"
                                onClick=event.stopPropagation(); >
                            <button class="btn btn-primary" >Edit</button></a>
                            <a href="{{route('delcontentsDetails',$content_data->content_id)}}"
                                onclick="return confirm('Are you sure?')" class="delete_user"><button type="button"
                                    class="btn btn-danger ">Delete</button></a>
                        </td>
                        <td></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(function () {
        $(document).ready(function () {
            var bar = $('.bar');
            var percent = $('.percent');

            $('#contentSubmit').ajaxForm({
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
                    window.location.href = '{{route('getcontentsIndex',$get_subject_data->subject_id)}}';
                }
            });
            $('#bookSubmit').ajaxForm({
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
                    window.location.href = '{{route('getcontentsIndex',$get_subject_data->subject_id)}}';
                }
            });
        });
    });
</script>

<script>
    $("#addbookbutton").click(function () {
        $('.addbookform').removeAttr("hidden");
        $('.addcontentform').attr("hidden", "true");
    });

    $("#addcontentbutton").click(function () {
        $('.addcontentform').removeAttr("hidden");
        $('.addbookform').attr("hidden", "true");
    });

</script>

<script>
    // $("#audiofile").on("change", function () {
    //     if ($("#audiofile")[0].files.length > 5) {
    //         var $el = $('#audiofile');
    //         $el.wrap('<form>').closest('form').get(0).reset();
    //         $el.unwrap();
    //         alert("cannot upload more than 5 files at a time.");
    //     }
    // });
</script>
