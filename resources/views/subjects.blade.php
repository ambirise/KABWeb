@extends('home')
@section('content')

<div class="container">
    <a href="{{ url('/levels') }}"><span>Levels</span></a> -> <a
        href="{{ url('/faculties',$get_semester_data->level_id) }}"><span>Faculties</span></a>
    -> <a href="{{ url('/semesters',$get_semester_data->faculty_id) }}"><span>Semesters</span></a>
    -> <a href="{{ url('/subjects',$get_semester_data->semester_id) }}"><span>Subjects</span></a>
    <div class="card mt-4">
        <div class="card-body">

            <form action="{{route('subjectsStore',$get_semester_data->semester_id)}}" method="POST" enctype="mutipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="col-md-4">
                            <span style="font-size:16px;">Subject</span>
                            <input type="text" name="subject" class="form-control" id="usr" style="width:182px;"><br>
                        </div>
                    </div>
                    <div class="col-md-6"><br>
                        <button type="submit" class="btn btn-primary">ADD</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>

<div class="container">
    <div class="card mt-2">
        <div class="card-header text-center">
            <div class="row">
                <div class="col-md-8">
                    <form action="" method="POST" role="search">
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
                    <!-- <button class="btn btn-outline-primary" id="addfacultybutton" style="float:right">ADD</button> -->
                </div>
            </div>
        </div>
        <div class="card-body">


            <table class="table mt-0 table-striped">
                <thead>
                    <tr>
                        <th scope="col">S.N</th>
                        <th scope="col">Level Title</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($get_subject_data as $key=>$subject_data) 
                    <tr onclick="window.location = '{{route('getchaptersIndex',$subject_data->subject_id)}}'"
                            style="cursor:pointer;">
                        <td>{{$key+1}}</td>
                        <td>{{$subject_data->subject_title}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
