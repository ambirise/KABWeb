@extends('home')
@section('content')

<div class="container"><br>
    <a href="{{ url('/levels') }}"><span>Levels</span></a> -> <a
        href="{{ url('/faculties',$get_semester_data->level_id) }}"><span>{{$level_title->level_title}}</span></a>
    <!-- -> <a href="{{ url('/semesters',$get_semester_data->faculty_id) }}"><span>Semesters</span></a> -->
    -> <a href="{{ url('/subjects', $get_semester_data->faculty_id) }}"><span>{{$get_faculty_data->faculty_title}}</span></a>
    <form action="{{route('subjectsStore',$get_semester_data->faculty_id)}}" method="POST" enctype="mutipart/form-data">
        <div class="card mt-2 addsubjectform" hidden="true">
            <div class="card-body" style="padding:8px;">
                @csrf
                <div class="row">
                    @if($get_semester_data->yearorsemester == "s" && $get_semester_data->numberofsemester == "6")
                    <div class="col-md-6">
                        <span style="font-size:16px;">Select Semester</span><br>
                        <select class="custom-select" name="year" style="height:38px;width:182px;" id="customchange"
                            required>
                            <option value="First Semester" selected>First</option>
                            <option value="Second Semester">Second</option>
                            <option value="Third Semester">Third</option>
                            <option value="Fourth Semester">Fourth</option>
                            <option value="Fifth Semester">Fifth</option>
                            <option value="Sixth Semester">Sixth</option>
                        </select>
                    </div>
                    @endif

                    @if($get_semester_data->yearorsemester == "s" && $get_semester_data->numberofsemester == "8")
                    <div class="col-md-6">
                        <span style="font-size:16px;">Select Semester</span><br>
                        <select class="custom-select" name="year" style="height:38px;width:182px;" id="customchange"
                            required>
                            <option value="First Semester" selected>First</option>
                            <option value="Second Semester">Second</option>
                            <option value="Third Semester">Third</option>
                            <option value="Fourth Semester">Fourth</option>
                            <option value="Fifth Semester">Fifth</option>
                            <option value="Sixth Semester">Sixth</option>
                            <option value="Seventh Semester">Seventh</option>
                            <option value="Eighth Semester">Eighth</option>
                        </select>
                    </div>
                    @endif

                    @if($get_semester_data->yearorsemester == "s" && $get_semester_data->numberofsemester == "10")
                    <div class="col-md-6">
                        <span style="font-size:16px;">Select Semester</span><br>
                        <select class="custom-select" name="year" style="height:38px;width:182px;" id="customchange"
                            required>
                            <option value="First Semester" selected>First</option>
                            <option value="Second Semester">Second</option>
                            <option value="Third Semester">Third</option>
                            <option value="Fourth Semester">Fourth</option>
                            <option value="Fifth Semester">Fifth</option>
                            <option value="Sixth Semester">Sixth</option>
                            <option value="Seventh Semester">Seventh</option>
                            <option value="Eighth Semester">Eighth</option>
                            <option value="Nineth Semester">Nine</option>
                            <option value="Tenth Semester">Ten</option>
                        </select>
                    </div>
                    @endif

                    @if($get_semester_data->yearorsemester == "y" && $get_semester_data->numberofyear == "3")
                    <div class="col-md-6">
                        <span style="font-size:16px;">Select Year</span><br>
                        <select class="custom-select" name="year" style="height:38px;width:182px;" id="customchange"
                            required>
                            <option value="First Year" selected>First</option>
                            <option value="Second Year">Second</option>
                            <option value="Third Year">Third</option>
                        </select>
                    </div>
                    @endif

                    @if($get_semester_data->yearorsemester == "y" && $get_semester_data->numberofyear == "4")
                    <div class="col-md-6">
                        <span style="font-size:16px;">Select Year</span><br>
                        <select class="custom-select" name="year" style="height:38px;width:182px;" id="customchange"
                            required>
                            <option value="First Year" selected>First</option>
                            <option value="Second Year">Second</option>
                            <option value="Third Year">Third</option>
                            <option value="Fourth Year">Fourth</option>
                        </select>
                    </div>
                    @endif

                    @if($get_semester_data->yearorsemester == "y" && $get_semester_data->numberofyear == "5")
                    <div class="col-md-6">
                        <span style="font-size:16px;">Select Year</span><br>
                        <select class="custom-select" name="year" style="height:38px;width:182px;" id="customchange"
                            required>
                            <option value="First Year" selected>First</option>
                            <option value="Second Year">Second</option>
                            <option value="Third Year">Third</option>
                            <option value="Fourth Year">Fourth</option>
                            <option value="Fifth Year">Fifth</option>
                        </select>
                    </div>
                    @endif


                    <div class="col-md-6">
                        <span style="font-size:16px;">Subject</span>
                        <input type="text" name="subject" class="form-control input-sm" id="usr"
                            style="width:260px;" required><br>
                    </div>
                </div>



                <div class="col-md-6"><br>
                    <button type="submit" class="btn btn-primary">ADD</button>
                </div>
            </div>
        </div>
    </form>
</div>

@if($message = Session::get('violation'))
<div class="container mt-2">
    <div class="card alert alert-danger" role="alert">
        <p>{{$message}}<p>
    </div>
</div>
@endif

@if($message = Session::get('updatesuccess'))
<div class="container mt-2">
    <div class="card alert alert-success" role="alert">
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
                    <form action="{{ route('getsubjectsSearch',$get_semester_data->faculty_id)}}" method="POST" role="search">
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
                    <button class="btn btn-outline-primary" id="addsubjectbutton" style="float:right">ADD</button>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table class="table mt-0 table-striped">
                <thead>
                    <tr>
                        <th scope="col">S.N</th>
                        <th scope="col">Subject Title</th>
                        @if($get_semester_data->yearorsemester == "y")
                        <th scope="col">Year</th>
                        @endif
                        @if($get_semester_data->yearorsemester == "s")
                        <th scope="col">Semester</th>
                        @endif
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
                            <a href="{{route('editsubjectsDetails',$subject_data->subject_id)}}" NAME="Error Handling" title="ZeroDivisionError handling"
                                onClick=event.stopPropagation();>
                                <button class="btn btn-primary">Edit</button></a>
                            <a href="{{route('delsubjectsDetails',$subject_data->subject_id)}}"
                                onclick="return confirmClick();" class="delete_user"><button type="button"
                                    class="btn btn-danger ">Delete</button></a>
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
                            <a href="{{route('editsubjectsDetails',$subject_data->subject_id)}}" NAME="Error Handling" title="ZeroDivisionError handling"
                                onClick=event.stopPropagation();>
                                <button class="btn btn-primary">Edit</button></a>
                            <a href="{{route('delsubjectsDetails',$subject_data->subject_id)}}"
                                onclick="return confirmClick();" class="delete_user"><button type="button"
                                    class="btn btn-danger ">Delete</button></a>
                        </td>
                    </tr>
                    @endforeach
                    @endif

                    @endif
                    <!-- End of main if condition -->

                    <!-- For second if condition -->
                    @if(($get_faculty_data->level_id == "3"))
                    @if(isset($details))
                    @php
                    $i=0;
                    @endphp
                    @foreach($get_all_subjects_from_semester as $subject_data)
                    @php
                    $i++;
                    @endphp
                    <tr onclick="window.location = '{{route('getchaptersIndex',$subject_data->subject_id)}}'"
                        style="cursor:pointer;">
                        <th scope="row">{{$i}}</th>
                        <td>{{$subject_data->subject_title}}</td>
                        <td>{{$subject_data->semester_choosen}}</td>
                      
                        <td>
                            <a href="{{route('editsubjectsDetails',$subject_data->subject_id)}}" NAME="Error Handling" title="ZeroDivisionError handling"
                                onClick=event.stopPropagation();>
                                <button class="btn btn-primary">Edit</button></a>
                            <a href="{{route('delsubjectsDetails',$subject_data->subject_id)}}"
                                onclick="return confirmClick();" class="delete_user"><button type="button"
                                    class="btn btn-danger ">Delete</button></a>
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
                    @foreach($get_all_subjects_from_semester as $subject_data)
                    @php
                    $i++;
                    @endphp
                    <tr onclick="window.location = '{{route('getchaptersIndex',$subject_data->subject_id)}}'"
                        style="cursor:pointer;">
                        <th scope="row">{{$i}}</th>
                        <td>{{$subject_data->subject_title}}</td>
                        <td>{{$subject_data->semester_choosen}}</td>
                        <td>
                            <a href="{{route('editsubjectsDetails',$subject_data->subject_id)}}" NAME="Error Handling" title="ZeroDivisionError handling"
                                onClick=event.stopPropagation();>
                                <button class="btn btn-primary">Edit</button></a>
                            <a href="{{route('delsubjectsDetails',$subject_data->subject_id)}}"
                                onclick="return confirmClick();" class="delete_user"><button type="button"
                                    class="btn btn-danger ">Delete</button></a>
                        </td>
                    </tr>
                    @endforeach
                    @endif

                    @endif

                    <!-- End of second if condition -->

                    <!-- For third if condition -->
                    @if(($get_faculty_data->level_id == "4"))
                    @if(isset($details))
                    @php
                    $i=0;
                    @endphp
                    @foreach($get_subject_data->where('level_id', 4) as $subject_data)
                    @php
                    $i++;
                    @endphp
                    <tr onclick="window.location = '{{route('getchaptersIndex',$subject_data->subject_id)}}'"
                        style="cursor:pointer;">
                        <th scope="row">{{$i}}</th>
                        <td>{{$subject_data->subject_title}}</td>
                        <td>
                            <a href="{{route('editsubjectsDetails',$subject_data->subject_id)}}" NAME="Error Handling" title="ZeroDivisionError handling"
                                onClick=event.stopPropagation();>
                                <button class="btn btn-primary">Edit</button></a>
                            <a href="{{route('delsubjectsDetails',$subject_data->subject_id)}}"
                                onclick="return confirmClick();" class="delete_user"><button type="button"
                                    class="btn btn-danger ">Delete</button></a>
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
                    @foreach($get_subject_data->where('level_id', 4) as $subject_data)
                    @php
                    $i++;
                    @endphp
                    <tr onclick="window.location = '{{route('getchaptersIndex',$subject_data->subject_id)}}'"
                        style="cursor:pointer;">
                        <th scope="row">{{$i}}</th>
                        <td>{{$subject_data->subject_title}}</td>
                        <td>
                            <a href="{{route('editsubjectsDetails',$subject_data->subject_id)}}" NAME="Error Handling" title="ZeroDivisionError handling"
                                onClick=event.stopPropagation();>
                                <button class="btn btn-primary">Edit</button></a>
                            <a href="{{route('delsubjectsDetails',$subject_data->subject_id)}}"
                                onclick="return confirmClick();" class="delete_user"><button type="button"
                                    class="btn btn-danger ">Delete</button></a>
                        </td>
                    </tr>
                    @endforeach
                    @endif

                    @endif

                    <!-- End of third if condition -->

                    <!-- For fourth if condition -->
                    @if(($get_faculty_data->level_id == "5"))
                    @if(isset($details))
                    @php
                    $i=0;
                    @endphp
                    @foreach($get_subject_data->where('level_id', 5) as $subject_data)
                    @php
                    $i++;
                    @endphp
                    <tr onclick="window.location = '{{route('getchaptersIndex',$subject_data->subject_id)}}'"
                        style="cursor:pointer;">
                        <th scope="row">{{$i}}</th>
                        <td>{{$subject_data->subject_title}}</td>
                        <td>
                            <a href="{{route('editsubjectsDetails',$subject_data->subject_id)}}" NAME="Error Handling" title="ZeroDivisionError handling"
                                onClick=event.stopPropagation();>
                                <button class="btn btn-primary">Edit</button></a>
                            <a href="{{route('delsubjectsDetails',$subject_data->subject_id)}}"
                                onclick="return confirmClick();" class="delete_user"><button type="button"
                                    class="btn btn-danger ">Delete</button></a>
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
                    @foreach($get_subject_data->where('level_id', 5) as $subject_data)
                    @php
                    $i++;
                    @endphp
                    <tr onclick="window.location = '{{route('getchaptersIndex',$subject_data->subject_id)}}'"
                        style="cursor:pointer;">
                        <th scope="row">{{$i}}</th>
                        <td>{{$subject_data->subject_title}}</td>
                        <td>
                            <a href="{{route('editsubjectsDetails',$subject_data->subject_id)}}" NAME="Error Handling" title="ZeroDivisionError handling"
                                onClick=event.stopPropagation();>
                                <button class="btn btn-primary">Edit</button></a>
                            <a href="{{route('delsubjectsDetails',$subject_data->subject_id)}}"
                                onclick="return confirmClick();" class="delete_user"><button type="button"
                                    class="btn btn-danger ">Delete</button></a>
                        </td>
                    </tr>
                    @endforeach
                    @endif

                    @endif

                    <!-- End of fourth if condition -->

                    <!-- For fifth if condition -->
                    @if(($get_faculty_data->level_id == "6"))
                    @if(isset($details))
                    @php
                    $i=0;
                    @endphp
                    @foreach($get_subject_data->where('level_id', 6) as $subject_data)
                    @php
                    $i++;
                    @endphp
                    <tr onclick="window.location = '{{route('getchaptersIndex',$subject_data->subject_id)}}'"
                        style="cursor:pointer;">
                        <th scope="row">{{$i}}</th>
                        <td>{{$subject_data->subject_title}}</td>
                        <td>
                            <a href="{{route('editsubjectsDetails',$subject_data->subject_id)}}" NAME="Error Handling" title="ZeroDivisionError handling"
                                onClick=event.stopPropagation();>
                                <button class="btn btn-primary">Edit</button></a>
                            <a href="{{route('delsubjectsDetails',$subject_data->subject_id)}}"
                                onclick="return confirmClick();" class="delete_user"><button type="button"
                                    class="btn btn-danger ">Delete</button></a>
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
                    @foreach($get_subject_data->where('level_id', 6) as $subject_data)
                    @php
                    $i++;
                    @endphp
                    <tr onclick="window.location = '{{route('getchaptersIndex',$subject_data->subject_id)}}'"
                        style="cursor:pointer;">
                        <th scope="row">{{$i}}</th>
                        <td>{{$subject_data->subject_title}}</td>
                        <td>
                            <a href="{{route('editsubjectsDetails',$subject_data->subject_id)}}" NAME="Error Handling" title="ZeroDivisionError handling"
                                onClick=event.stopPropagation();>
                                <button class="btn btn-primary">Edit</button></a>
                            <a href="{{route('delsubjectsDetails',$subject_data->subject_id)}}"
                                onclick="return confirmClick();" class="delete_user"><button type="button"
                                    class="btn btn-danger ">Delete</button></a>
                        </td>
                    </tr>
                    @endforeach
                    @endif

                    @endif

                    <!-- End of fifth if condition -->

                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    $("#addsubjectbutton").click(function () {
        $('.addsubjectform').removeAttr("hidden");
    });

    function confirmClick() {
        if (confirm("Are you sure?")) {
            return true;
        } else {
            event.stopPropagation();
            return false;
        }
    };
</script>

@endsection
