@extends('home')
@section('content')

<div class="container"><br>
    <a href="{{ url('/levels') }}"><span>Levels</span></a> -> <a
        href="{{ url('/faculties',$get_semester_data->level_id) }}"><span>{{$level_title->level_title}}</span></a>
    <!-- -> <a href="{{ url('/semesters',$get_semester_data->faculty_id) }}"><span>Semesters</span></a> -->
    -> <a
        href="{{ url('/subjects', $get_semester_data->faculty_id) }}"><span>{{$get_faculty_data->faculty_title}}</span></a>

    <form action="{{route('subjectsStore',$get_semester_data->faculty_id)}}" method="POST" enctype="mutipart/form-data">

        <div class="card mt-2">
            <div class="card-body" style="padding:8px;">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        @if($get_semester_data->yearorsemester == "s" && $get_semester_data->numberofsemester == "6")
                        <span style="font-size:16px;">Select Semester</span><br>
                        <select class="custom-select" name="year" style="height:38px;width:182px;" id="customchange"
                            required>
                            <option value="1s" selected>First</option>
                            <option value="2s">Second</option>
                            <option value="3s">Third</option>
                            <option value="4s">Fourth</option>
                            <option value="5s">Fifth</option>
                            <option value="6s">Sixth</option>
                        </select>
                        @endif

                        @if($get_semester_data->yearorsemester == "s" && $get_semester_data->numberofsemester == "8")
                        <span style="font-size:16px;">Select Semester</span><br>
                        <select class="custom-select" name="year" style="height:38px;width:182px;" id="customchange"
                            required>
                            <option value="1s" selected>First</option>
                            <option value="2s">Second</option>
                            <option value="3s">Third</option>
                            <option value="4s">Fouth</option>
                            <option value="5s">Fifth</option>
                            <option value="6s">Sixth</option>
                            <option value="7s">Seventh</option>
                            <option value="8s">Eighth</option>
                        </select>
                        @endif

                        @if($get_semester_data->yearorsemester == "s" && $get_semester_data->numberofsemester == "10")
                        <span style="font-size:16px;">Select Semester</span><br>
                        <select class="custom-select" name="year" style="height:38px;width:182px;" id="customchange"
                            required>
                            <option value="1s" selected>First</option>
                            <option value="2s">Second</option>
                            <option value="3s">Third</option>
                            <option value="4s">Fouth</option>
                            <option value="5s">Fifth</option>
                            <option value="6s">Sixth</option>
                            <option value="7s">Seventh</option>
                            <option value="8s">Eighth</option>
                            <option value="9s">Nine</option>
                            <option value="10s">Ten</option>
                        </select>
                        @endif

                        @if($get_semester_data->yearorsemester == "s" && $get_semester_data->numberofsemester == "3")
                        <span style="font-size:16px;">Select Year</span><br>
                        <select class="custom-select" name="year" style="height:38px;width:182px;" id="customchange"
                            required>
                            <option value="1y" selected>First</option>
                            <option value="2y">Second</option>
                            <option value="3y">Third</option>
                        </select>
                        @endif

                        @if($get_semester_data->yearorsemester == "s" && $get_semester_data->numberofsemester == "4")
                        <span style="font-size:16px;">Select Year</span><br>
                        <select class="custom-select" name="year" style="height:38px;width:182px;" id="customchange"
                            required>
                            <option value="1y" selected>First</option>
                            <option value="2y">Second</option>
                            <option value="3y">Third</option>
                            <option value="4y">Fourth</option>
                        </select>
                        @endif

                        @if($get_semester_data->yearorsemester == "s" && $get_semester_data->numberofsemester == "5")
                        <span style="font-size:16px;">Select Year</span><br>
                        <select class="custom-select" name="year" style="height:38px;width:182px;" id="customchange"
                            required>
                            <option value="1y" selected>First</option>
                            <option value="2y">Second</option>
                            <option value="3y">Third</option>
                            <option value="4y">Fourth</option>
                            <option value="5y">Fifth</option>
                        </select>
                        @endif
                    </div>
                </div>

                <div class="col-md-6">
                    <span style="font-size:16px;">Subject</span>
                    <input type="text" name="subject" class="form-control input-sm" id="usr"
                        style="width:182px;margin:0;padding:6;"><br>
                </div>
                <div class="col-md-6"><br>
                    <button type="submit" class="btn btn-primary">ADD</button>
                </div>
            </div>
        </div>
    </form>
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
                        <th scope="col">Faculty Title</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- For main if condition -->
                    @if(($get_faculty_data->level_id == "1"))
                    @if(isset($details))
                    @php
                    $i=0;
                    @endphp
                    @foreach($get_subject_data->where('level_id', 1) as $subject_data)
                    @php
                    $i++;
                    @endphp
                    <tr onclick="window.location = '{{route('getchaptersIndex',$subject_data->subject_id)}}'"
                        style="cursor:pointer;">
                        <th scope="row">{{$i}}</th>
                        <td>{{$subject_data->subject_title}}</td>
                        <td>
                            <a><button class="btn btn-primary">Edit</button></a>
                            <a href="" onclick="return confirm('Are you sure?')" class="delete_user"><button
                                    type="button" class="btn btn-danger ">Delete</button></a>
                        </td>
                    </tr>

                    @endforeach

                    @else
                    @php
                    $i=0;
                    @endphp
                    @php
                    $i=0;
                    @endphp
                    @foreach($get_subject_data->where('level_id', 1) as $subject_data)
                    @php
                    $i++;
                    @endphp
                    <tr onclick="window.location = '{{route('getchaptersIndex',$subject_data->subject_id)}}'"
                        style="cursor:pointer;">
                        <th scope="row">{{$i}}</th>
                        <td>{{$subject_data->subject_title}}</td>
                        <td>
                            <a><button class="btn btn-primary">Edit</button></a>
                            <a href="" onclick="return confirm('Are you sure?')" class="delete_user"><button
                                    type="button" class="btn btn-danger ">Delete</button></a>
                        </td>
                    </tr>
                    @endforeach
                    @endif

                    @endif
                    <!-- End of main if condition -->

                     <!-- For main if condition -->
                     @if(($get_faculty_data->level_id == "3"))
                    @if(isset($details))
                    @php
                    $i=0;
                    @endphp
                    @foreach($get_subject_data->where('level_id', 3) as $subject_data)
                    @php
                    $i++;
                    @endphp
                    <tr onclick="window.location = '{{route('getchaptersIndex',$subject_data->subject_id)}}'"
                        style="cursor:pointer;">
                        <th scope="row">{{$i}}</th>
                        <td>{{$subject_data->subject_title}}</td>
                        <td>
                            <a><button class="btn btn-primary">Edit</button></a>
                            <a href="" onclick="return confirm('Are you sure?')" class="delete_user"><button
                                    type="button" class="btn btn-danger ">Delete</button></a>
                        </td>
                    </tr>

                    @endforeach

                    @else
                    @php
                    $i=0;
                    @endphp
                    @php
                    $i=0;
                    @endphp
                    @foreach($get_subject_data->where('level_id', 3) as $subject_data)
                    @php
                    $i++;
                    @endphp
                    <tr onclick="window.location = '{{route('getchaptersIndex',$subject_data->subject_id)}}'"
                        style="cursor:pointer;">
                        <th scope="row">{{$i}}</th>
                        <td>{{$subject_data->subject_title}}</td>
                        <td>
                            <a><button class="btn btn-primary">Edit</button></a>
                            <a href="" onclick="return confirm('Are you sure?')" class="delete_user"><button
                                    type="button" class="btn btn-danger ">Delete</button></a>
                        </td>
                    </tr>
                    @endforeach
                    @endif

                    @endif


                    <!-- End of main if condition -->
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
