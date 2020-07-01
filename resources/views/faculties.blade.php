@extends('home')
@section('content')

<div class="container"><br>
    <a href="{{ url('/') }}"><span>Levels</span></a> -> <a
        href="{{ url('/faculties',$get_level_data->level_id) }}"><span>{{$get_level_data->level_title}}</span></a>
    <div class="card mt-4 addfacultyform" hidden="true">
        <div class="card-header">
            <h5>Insert Faculty</h5>
        </div>
        <div class="card-body">
            <form action="{{route('facultiesStore')}}" method="POST" enctype="mutipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-4">
                        <br>
                        <span style="font-size:16px;">Level : {{$get_level_data->level_title}}</span><br>
                        <!-- <select class="custom-select getlevelname" name="levelchoose" style="height:38px;width:182px;"
                            id="customchange" disabled>
                            <option value="" selected>{{$get_level_data->level_title}}</option>
                        </select> -->
                        <input type="text" name="levelid" hidden="true" class="form-control" value="{{$level_id}}"
                            id="usr" style="width:182px;">
                    </div>

                    @if($get_level_data->level_title=='School')
                    <div class="col-md-4 hideclass">
                        <br>
                        <span style="font-size:16px;">Add Class</span>
                        <select class="custom-select" name="facultyschool" style="height:38px;width:182px;"
                            id="customchange" required>
                            <option value="" selected>Select Level</option>
                            <option value="One">Class One</option>
                            <option value="Two">Class Two</option>
                            <option value="Three">Class Three</option>
                            <option value="Four">Class Four</option>
                            <option value="Five">Class Five</option>
                            <option value="Six">Class Six</option>
                            <option value="Seven">Class Seven</option>
                            <option value="Eight">Class Eight</option>
                            <option value="Nine">Class Nine</option>
                            <option value="Ten">Class Ten</option>
                        </select>
                    </div>
                    @endif

                    @if($get_level_data->level_title=='10+2')
                    <div class="col-md-4 hideclass">
                        <br>
                        <span style="font-size:16px;">Add Class</span>
                        <select class="custom-select" name="facultyschool" style="height:38px;width:182px;"
                            id="customchange" required>
                            <option value="" selected>Select Level</option>
                            <option value="Eleven">Eleven</option>
                            <option value="Twelve">Twelve</option>
                        </select>
                    </div>
                    @endif

                    @if($get_level_data->level_title=='Loksewa' || $get_level_data->level_title=='Others')
                    <div class="col-md-4">
                        <span style="font-size:16px;">Field</span>
                        <input type="text" name="facultybachelor" class="form-control" id="usr"
                            style="width:182px;" required><br>
                    </div>
                    @endif

                    @if($get_level_data->level_title=='Bachelor')
                    <div class="col-md-4 hidefaculty">
                        <span style="font-size:16px;">Faculty</span>
                        <input type="text" name="facultybachelor" class="form-control" id="usr"
                            style="width:182px;" required><br>
                    </div>

                    <div class="col-md-4 hidesemesterandyear">
                        <span style="font-size:16px;">Choose Semester or Year</span>
                        <div>
                            <label class="btn btn-light">
                                <input type="radio" name="Semester" Value="s" autocomplete="off" required>
                                Semester
                            </label>
                            <label class="btn btn-light">
                                <input type="radio" name="Semester" value="y" autocomplete="off" required> Year
                            </label>
                        </div>
                    </div>
                    <div class="col-md-4 hideyears" hidden="true">
                        <span style="font-size:16px;">Number of Years</span>

                        <div>
                            <label class="btn btn-light">
                                <input type="radio" name="numberofyear" Value="3" autocomplete="off">
                                Three
                            </label>
                            <label class="btn btn-light">
                                <input type="radio" name="numberofyear" value="4" autocomplete="off">Four
                            </label>
                            <label class="btn btn-light">
                                <input type="radio" name="numberofyear" value="5" autocomplete="off">Five
                            </label>
                        </div>
                    </div>
 
                    <div class="col-md-4 hidesemesters" hidden="true">
                        <span style="font-size:16px;">Number of Semesters</span>

                        <div>
                            <label class="btn btn-light">
                                <input type="radio" name="numberofsemester" Value="6" autocomplete="off">
                                Six
                            </label>
                            <label class="btn btn-light">
                                <input type="radio" name="numberofsemester" value="8" autocomplete="off">Eight
                            </label>
                            <label class="btn btn-light">
                                <input type="radio" name="numberofsemester" value="10" autocomplete="off">Ten
                            </label>
                        </div>
                    </div>
                    @endif


                    @if($get_level_data->level_title=='Masters')
                    <div class="col-md-4">
                        <span style="font-size:16px;">Faculty</span>
                        <input type="text" name="facultybachelor" class="form-control" id="usr"
                            style="width:182px;" required><br>
                        <input type="hidden" name="numberofyear" Value="2" autocomplete="off">
                        <input type="hidden" name="Semester" value="y" autocomplete="off" required>
                    </div>
                    @endif

                    <!-- <div class="col-md-4 hideselectyearfirst" >
                        <span style="font-size:16px;">Select Year</span><br>
                        <select class="custom-select" name="year" style="height:38px;width:182px;" id="customchange"
                            required>
                            <option value="1" selected>First</option>
                            <option value="2">Second</option>
                            <option value="3">Third</option>
                        </select>
                    </div>



                    <div class="col-md-4 hideselectyearsecond" >

                        <span style="font-size:16px;">Select Year</span><br>
                        <select class="custom-select" name="year" style="height:38px;width:182px;" id="customchange"
                            required>
                            <option value="1" selected>First</option>
                            <option value="2">Second</option>
                            <option value="3">Third</option>
                            <option value="4">Fourth</option>
                        </select>

                    </div>

                    <div class="col-md-4 hideselectyearthird" >

                        <span style="font-size:16px;">Select Year</span><br>
                        <select class="custom-select" name="year" style="height:38px;width:182px;" id="customchange"
                            required>
                            <option value="1" selected>First</option>
                            <option value="2">Second</option>
                            <option value="3">Third</option>
                            <option value="4">Fourth</option>
                            <option value="5">Fifth</option>
                        </select>

                    </div>

                    <div class="col-md-4 hideselectsemesterfirst" >
                        <span style="font-size:16px;">Select Semester</span><br>
                        <select class="custom-select" name="year" style="height:38px;width:182px;" id="customchange"
                            required>
                            <option value="1" selected>First</option>
                            <option value="2">Second</option>
                            <option value="3">Third</option>
                            <option value="4">Fourth</option>
                            <option value="5">Fifth</option>
                            <option value="6">Sixth</option>
                        </select>
                    </div>

                    <div class="col-md-4 hideselectsemestersecond" >

                        <span style="font-size:16px;">Select Semester</span><br>
                        <select class="custom-select" name="year" style="height:38px;width:182px;" id="customchange"
                            required>
                            <option value="1" selected>First</option>
                            <option value="2">Second</option>
                            <option value="3">Third</option>
                            <option value="4">Fouth</option>
                            <option value="5">Fifth</option>
                            <option value="6">Sixth</option>
                            <option value="7">Seventh</option>
                            <option value="8">Eighth</option>
                        </select>

                    </div>
                    <div class="col-md-4 hideselectsemesterthird" >

                        <span style="font-size:16px;">Select Semester</span><br>
                        <select class="custom-select" name="year" style="height:38px;width:182px;" id="customchange"
                            required>
                            <option value="1" selected>First</option>
                            <option value="2">Second</option>
                            <option value="3">Third</option>
                            <option value="4">Fouth</option>
                            <option value="5">Fifth</option>
                            <option value="6">Sixth</option>
                            <option value="7">Seventh</option>
                            <option value="8">Eighth</option>
                            <option value="9">Nine</option>
                            <option value="10">Ten</option>
                        </select>

                    </div> -->

                    <div class="col-md-4"><br>
                        <button type="submit" class="btn btn-primary">ADD</button>
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
        <div class="card-header ">
            <div class="row">
                <div class="col-md-8">
                    <form action="{{ route('getfacultiesSearch',$get_level_data->level_id)}}" method="POST"
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

                @if(($get_level_data->level_id == "3" || $get_level_data->level_id == "5" || $get_level_data->level_id
                == "9" || $get_level_data->level_id == "7"))
                <div class="col-md-4">
                    <button class="btn btn-outline-primary" id="addfacultybutton" style="float:right">ADD</button>
                </div>
                @endif
            </div>
        </div>
        <div class="card-body">
            <table class="table mt-0 table-striped">
                <thead>
                    <tr>
                        <th scope="col">S.N</th>
                        @if(($get_level_data->level_id == "3" || $get_level_data->level_id == "7"))
                        <th scope="col">Faculty</th>
                        @endif
                        @if(($get_level_data->level_id == "1"))
                        <th scope="col">Class</th>
                        @endif
                        @if(($get_level_data->level_id == "4"))
                        <th scope="col">Class</th>
                        @endif
                        @if(($get_level_data->level_id == "5"))
                        <th scope="col">Field</th>
                        @endif
                        @if(($get_level_data->level_id == "9"))
                        <th scope="col">Field</th>
                        @endif

                        @if(($get_level_data->level_id == "1" || $get_level_data->level_id == "4"))

                        @else
                        <th scope="col">Action</th>
                        @endif
                    </tr>
                </thead>
                <tbody>

                    <!-- For main if condition -->
                    @if(($get_level_data->level_id == "3"))
                    @if(isset($details))
                    @php
                    $i=0;
                    @endphp
                    @foreach($get_faculty_data->where('level_id', 3) as $faculty_data)
                    @php
                    $i++;
                    @endphp
                    <tr onclick="window.location = '{{route('getsubjectsIndex',$faculty_data->faculty_id)}}'"
                        style="cursor:pointer;">
                        <th scope="row">{{$i}}</th>
                        <td>{{$faculty_data->faculty_title}}</td>
                        <!-- {{ route('editfacultiesDetails', $faculty_data->faculty_id)}} -->
                        <td><a href="{{route('editfacultiesDetails',$faculty_data->faculty_id)}}" NAME="Error Handling" title="ZeroDivisionError handling"
                                onClick="event.stopPropagation();">
                                <button class="btn btn-primary">Edit</button></a>
                            <a href="{{route('delfacultiesDetails',$faculty_data->faculty_id)}}"
                                onclick="return confirmClick();" class="delete_user"><button type="button"
                                    class="btn btn-danger ">Delete</button></a>
                        </td>
                        @if($get_faculty_data->isEmpty())
                        this is home
                        @endif
                    </tr>

                    @endforeach

                    @else
                    @php
                    $i=0;
                    @endphp
                    @foreach($get_faculty_data->where('level_id', 3) as $faculty_data)
                    @php
                    $i++;
                    @endphp
                    <tr onclick="window.location = '{{route('getsubjectsIndex',$faculty_data->faculty_id)}}'"
                        style="cursor:pointer;">
                        <th scope="row">{{$i}}</th>
                        <td>{{$faculty_data->faculty_title}}</td>
                        <td><a href="{{route('editfacultiesDetails',$faculty_data->faculty_id)}}" NAME="Error Handling" title="ZeroDivisionError handling"
                                onClick="event.stopPropagation();">
                                <button class="btn btn-primary">Edit</button></a>
                            <a href="{{route('delfacultiesDetails',$faculty_data->faculty_id)}}"
                                onclick="return confirmClick();" class="delete_user"><button type="button"
                                    class="btn btn-danger ">Delete</button></a>
                        </td>
                    </tr>

                    @endforeach
                    @endif

                    @endif
                    <!-- End of main if condition -->

                    <!-- For second main if condition -->
                    @if($get_level_data->level_id == "1")
                    @if(isset($details))
                    @php
                    $i=0;
                    @endphp
                    @foreach($get_faculty_data->where('level_id', 1) as $faculty_data)
                    @php
                    $i++;
                    @endphp
                    <tr onclick="window.location = '{{route('getsubjectsIndex',$faculty_data->faculty_id)}}'"
                        style="cursor:pointer;">
                        <th scope="row">{{$i}}</th>
                        <td>{{$faculty_data->faculty_title}}</td>
                        @if($get_faculty_data->isEmpty())
                        this is home
                        @endif
                    </tr>

                    @endforeach

                    @else
                    @php
                    $i=0;
                    @endphp
                    @foreach($get_faculty_data->where('level_id', 1) as $faculty_data)
                    @php
                    $i++;
                    @endphp
                    <tr onclick="window.location = '{{route('getsubjectsIndex',$faculty_data->faculty_id)}}'"
                        style="cursor:pointer;">
                        <th scope="row">{{$i}}</th>
                        <td>{{$faculty_data->faculty_title}}</td>
                    </tr>

                    @endforeach
                    @endif

                    @endif
                    <!-- End of main if condition -->

                    <!-- For third main if condition -->
                    @if($get_level_data->level_id == "4")
                    @if(isset($details))
                    @php
                    $i=0;
                    @endphp
                    @foreach($get_faculty_data->where('level_id', 4) as $faculty_data)
                    @php
                    $i++;
                    @endphp
                    <tr onclick="window.location = '{{route('getsubjectsIndex',$faculty_data->faculty_id)}}'"
                        style="cursor:pointer;">
                        <th scope="row">{{$i}}</th>
                        <td>{{$faculty_data->faculty_title}}</td>

                        @if($get_faculty_data->isEmpty())
                        this is home
                        @endif
                    </tr>

                    @endforeach

                    @else
                    @php
                    $i=0;
                    @endphp
                    @foreach($get_faculty_data->where('level_id', 4) as $faculty_data)
                    @php
                    $i++;
                    @endphp
                    <tr onclick="window.location = '{{route('getsubjectsIndex',$faculty_data->faculty_id)}}'"
                        style="cursor:pointer;">
                        <th scope="row">{{$i}}</th>
                        <td>{{$faculty_data->faculty_title}}</td>
                    </tr>

                    @endforeach
                    @endif

                    @endif
                    <!-- End of main if condition -->

                    <!-- For fourth main if condition -->
                    @if($get_level_data->level_id == "5")
                    @if(isset($details))
                    @php
                    $i=0;
                    @endphp
                    @foreach($get_faculty_data->where('level_id', 5) as $faculty_data)
                    @php
                    $i++;
                    @endphp
                    <tr onclick="window.location = '{{route('getsubjectsIndex',$faculty_data->faculty_id)}}'"
                        style="cursor:pointer;">
                        <th scope="row">{{$i}}</th>
                        <td>{{$faculty_data->faculty_title}}</td>
                        <td><a href="{{route('editfacultiesDetails',$faculty_data->faculty_id)}}" NAME="Error Handling" title="ZeroDivisionError handling"
                                onClick="event.stopPropagation();">
                                <button class="btn btn-primary">Edit</button></a>
                            <a href="{{route('delfacultiesDetails',$faculty_data->faculty_id)}}"
                                onclick="return confirmClick();" class="delete_user"><button type="button"
                                    class="btn btn-danger ">Delete</button></a>
                        </td>
                        @if($get_faculty_data->isEmpty())
                        this is home
                        @endif
                    </tr>

                    @endforeach

                    @else
                    @php
                    $i=0;
                    @endphp
                    @foreach($get_faculty_data->where('level_id', 5) as $faculty_data)
                    @php
                    $i++;
                    @endphp
                    <tr onclick="window.location = '{{route('getsubjectsIndex',$faculty_data->faculty_id)}}'"
                        style="cursor:pointer;">
                        <th scope="row">{{$i}}</th>
                        <td>{{$faculty_data->faculty_title}}</td>
                        <td><a href="{{route('editfacultiesDetails',$faculty_data->faculty_id)}}" NAME="Error Handling" title="ZeroDivisionError handling"
                                onClick="event.stopPropagation();">
                                <button class="btn btn-primary">Edit</button></a>
                            <a href="{{route('delfacultiesDetails',$faculty_data->faculty_id)}}"
                                onclick="return confirmClick();" class="delete_user"><button type="button"
                                    class="btn btn-danger ">Delete</button></a>
                        </td>
                    </tr>

                    @endforeach
                    @endif

                    @endif
                    <!-- End of main if condition -->

                    <!-- For fifth main if condition -->
                    @if($get_level_data->level_id == "9")
                    @if(isset($details))
                    @php
                    $i=0;
                    @endphp
                    @foreach($get_faculty_data->where('level_id', 9) as $faculty_data)
                    @php
                    $i++;
                    @endphp
                    <tr onclick="window.location = '{{route('getsubjectsIndex',$faculty_data->faculty_id)}}'"
                        style="cursor:pointer;">
                        <th scope="row">{{$i}}</th>
                        <td>{{$faculty_data->faculty_title}}</td>
                        <td><a href="{{route('editfacultiesDetails',$faculty_data->faculty_id)}}" NAME="Error Handling" title="ZeroDivisionError handling"
                                onClick="event.stopPropagation();">
                                <button class="btn btn-primary">Edit</button></a>
                            <a href="{{route('delfacultiesDetails',$faculty_data->faculty_id)}}"
                                onclick="return confirmClick();" class="delete_user"><button type="button"
                                    class="btn btn-danger ">Delete</button></a>
                        </td>
                        @if($get_faculty_data->isEmpty())
                        this is home
                        @endif
                    </tr>

                    @endforeach

                    @else
                    @php
                    $i=0;
                    @endphp
                    @foreach($get_faculty_data->where('level_id', 9) as $faculty_data)
                    @php
                    $i++;
                    @endphp
                    <tr onclick="window.location = '{{route('getsubjectsIndex',$faculty_data->faculty_id)}}'"
                        style="cursor:pointer;">
                        <th scope="row">{{$i}}</th>
                        <td>{{$faculty_data->faculty_title}}</td>
                        <td><a href="{{route('editfacultiesDetails',$faculty_data->faculty_id)}}" NAME="Error Handling" title="ZeroDivisionError handling"
                                onClick="event.stopPropagation();">
                                <button class="btn btn-primary">Edit</button></a>
                            <a href="{{route('delfacultiesDetails',$faculty_data->faculty_id)}}"
                                onclick="return confirmClick();" class="delete_user"><button type="button"
                                    class="btn btn-danger ">Delete</button></a>
                        </td>
                    </tr>
                    @endforeach
                    @endif

                    @endif
                    <!-- End of main if condition -->

                 <!-- For main if condition for level id 6-->
                 @if(($get_level_data->level_id == "7"))
                    @if(isset($details))
                    @php
                    $i=0;
                    @endphp
                    @foreach($get_faculty_data->where('level_id', 7) as $faculty_data)
                    @php
                    $i++;
                    @endphp
                    <tr onclick="window.location = '{{route('getsubjectsIndex',$faculty_data->faculty_id)}}'"
                        style="cursor:pointer;">
                        <th scope="row">{{$i}}</th>
                        <td>{{$faculty_data->faculty_title}}</td>
                        <!-- {{ route('editfacultiesDetails', $faculty_data->faculty_id)}} -->
                        <td><a href="{{route('editfacultiesDetails',$faculty_data->faculty_id)}}" NAME="Error Handling" title="ZeroDivisionError handling"
                                onClick="event.stopPropagation();">
                                <button class="btn btn-primary">Edit</button></a>
                            <a href="{{route('delfacultiesDetails',$faculty_data->faculty_id)}}"
                                onclick="return confirmClick();" class="delete_user"><button type="button"
                                    class="btn btn-danger ">Delete</button></a>
                        </td>
                        @if($get_faculty_data->isEmpty())
                        this is home
                        @endif
                    </tr>

                    @endforeach

                    @else
                    @php
                    $i=0;
                    @endphp
                    @foreach($get_faculty_data->where('level_id', 7) as $faculty_data)
                    @php
                    $i++;
                    @endphp
                    <tr onclick="window.location = '{{route('getsubjectsIndex',$faculty_data->faculty_id)}}'"
                        style="cursor:pointer;">
                        <th scope="row">{{$i}}</th>
                        <td>{{$faculty_data->faculty_title}}</td>
                        <td><a href="{{route('editfacultiesDetails',$faculty_data->faculty_id)}}" NAME="Error Handling" title="ZeroDivisionError handling"
                                onClick="event.stopPropagation();">
                                <button class="btn btn-primary">Edit</button></a>
                            <a href="{{route('delfacultiesDetails',$faculty_data->faculty_id)}}"
                                onclick="return confirmClick();" class="delete_user"><button type="button"
                                    class="btn btn-danger ">Delete</button></a>
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

<script>
    $(document).ready(function () {
        $('input:radio[name="Semester"]').change(function () {
            if ($(this).val() == 'y') {
                $('.hideyears').removeAttr('hidden');
                $('.hidesemesters').attr("hidden", "false");
                $("input[name='numberofsemester']").attr('required', false);
                $("input[name='numberofyear']").attr('required', true);
                // $('.hideselectyearfirst').attr("hidden", "true");
                // $('.hideselectyearsecond').attr("hidden", "true");
                // $('.hideselectyearthird').attr("hidden", "true");

                // $('.hideselectsemesterfirst').attr("hidden", "true");
                // $('.hideselectsemestersecond').attr("hidden", "true");
                // $('.hideselectsemesterthird').attr("hidden", "true");
            }

            if ($(this).val() == 's') {
                $('.hidesemesters').removeAttr('hidden');
                $('.hideyears').attr("hidden", "false");
                $("input[name='numberofyear']").attr('required', false);
                $("input[name='numberofsemester']").attr('required', true);

                // $('.hideselectyearfirst').attr("hidden", "true");
                // $('.hideselectyearsecond').attr("hidden", "true");
                // $('.hideselectyearthird').attr("hidden", "true");

                // $('.hideselectsemesterfirst').attr("hidden", "true");
                // $('.hideselectsemestersecond').attr("hidden", "true");
                // $('.hideselectsemesterthird').attr("hidden", "true");
            }
        });
    });
</script>
<!--
//     $(document).ready(function () {
//         $("select.getlevelname").change(function () {
//             if ($(this).val() == '1') {
//                 $('.hideclass').removeAttr("hidden");
//                 $('.hidefaculty').attr("hidden", "true");
//                 $('.hidesemesterandyear').attr("hidden", "true");
//                 $('.hideyears').attr("hidden", "true");
//                 $('.hidesemesters').attr("hidden", "true");
//                 $('.hideselectyearfirst').attr("hidden", "true");
//                 $('.hideselectyearsecond').attr("hidden", "true");
//                 $('.hideselectyearthird').attr("hidden", "true");

//                 $('.hideselectsemesterfirst').attr("hidden", "true");
//                 $('.hideselectsemestersecond').attr("hidden", "true");
//                 $('.hideselectsemesterthird').attr("hidden", "true");
//             }
//             if ($(this).val() == '3') {
//                 $('.hidefaculty').removeAttr("hidden");
//                 $('.hideclass').attr("hidden", "true");
//                 $('.hidesemesterandyear').removeAttr("hidden");
//                 $('.hideyears').attr("hidden", "true");
//                 $('.hidesemesters').attr("hidden", "true");

//                 $('.hideselectsemesterfirst').attr("hidden", "true");
//                 $('.hideselectsemestersecond').attr("hidden", "true");
//                 $('.hideselectsemesterthird').attr("hidden", "true");
//             }
//             if ($(this).val() == '4') {
//                 $('.hideclass').removeAttr("hidden");
//                 $('.hidefaculty').attr("hidden", "true");
//                 $('.hidesemesterandyear').attr("hidden", "true");
//                 $('.hideyears').attr("hidden", "true");
//                 $('.hidesemesters').attr("hidden", "true");

//                 $('.hideselectyearfirst').attr("hidden", "true");
//                 $('.hideselectyearsecond').attr("hidden", "true");
//                 $('.hideselectyearthird').attr("hidden", "true");

//                 $('.hideselectsemesterfirst').attr("hidden", "true");
//                 $('.hideselectsemestersecond').attr("hidden", "true");
//                 $('.hideselectsemesterthird').attr("hidden", "true");
//             }
//             if ($(this).val() == '5') {
//                 $('.hidefaculty').removeAttr("hidden");
//                 $('.hideclass').attr("hidden", "true");
//                 $('.hidesemesterandyear').attr("hidden", "true");
//                 $('.hideyears').attr("hidden", "true");
//                 $('.hidesemesters').attr("hidden", "true");

//                 $('.hideselectyearfirst').attr("hidden", "true");
//                 $('.hideselectyearsecond').attr("hidden", "true");
//                 $('.hideselectyearthird').attr("hidden", "true");

//                 $('.hideselectsemesterfirst').attr("hidden", "true");
//                 $('.hideselectsemestersecond').attr("hidden", "true");
//                 $('.hideselectsemesterthird').attr("hidden", "true");
//             }
//         });
//     });

//     $(document).ready(function () {
//         $('input:radio[name="numberofyear"]').change(function () {
//             if ($(this).val() == 'three') {
//                 $('.hideselectyearfirst').removeAttr("hidden");
//                 $('.hideselectyearsecond').attr("hidden", "true");
//                 $('.hideselectyearthird').attr("hidden", "true");

//                 $('.hideselectsemesterfirst').attr("hidden", "true");
//                 $('.hideselectsemestersecond').attr("hidden", "true");
//                 $('.hideselectsemesterthird').attr("hidden", "true");
//             }

//             if ($(this).val() == 'four') {
//                 $('.hideselectyearsecond').removeAttr("hidden");
//                 $('.hideselectyearfirst').attr("hidden", "true");
//                 $('.hideselectyearthird').attr("hidden", "true");

//                 $('.hideselectsemesterfirst').attr("hidden", "true");
//                 $('.hideselectsemestersecond').attr("hidden", "true");
//                 $('.hideselectsemesterthird').attr("hidden", "true");
//             }

//             if ($(this).val() == 'five') {
//                 $('.hideselectyearthird').removeAttr("hidden");
//                 $('.hideselectyearsecond').attr("hidden", "true");
//                 $('.hideselectyearfirst').attr("hidden", "true");

//                 $('.hideselectsemesterfirst').attr("hidden", "true");
//                 $('.hideselectsemestersecond').attr("hidden", "true");
//                 $('.hideselectsemesterthird').attr("hidden", "true");
//             }
//         });

//     });

//     $(document).ready(function () {
//         $('input:radio[name="numberofsemester"]').change(function () {
//             if ($(this).val() == 'six') {
//                 $('.hideselectsemesterfirst').removeAttr("hidden");
//                 $('.hideselectsemestersecond').attr("hidden", "true");
//                 $('.hideselectsemesterthird').attr("hidden", "true");

//                 $('.hideselectyearfirst').attr("hidden", "true");
//                 $('.hideselectyearsecond').attr("hidden", "true");
//                 $('.hideselectyearthird').attr("hidden", "true");
//             }

//             if ($(this).val() == 'eight') {
//                 $('.hideselectsemestersecond').removeAttr("hidden");
//                 $('.hideselectsemesterfirst').attr("hidden", "true");
//                 $('.hideselectsemesterthird').attr("hidden", "true");

//                 $('.hideselectyearfirst').attr("hidden", "true");
//                 $('.hideselectyearsecond').attr("hidden", "true");
//                 $('.hideselectyearthird').attr("hidden", "true");
//             }

//             if ($(this).val() == 'ten') {
//                 $('.hideselectsemesterthird').removeAttr("hidden");
//                 $('.hideselectsemestersecond').attr("hidden", "true");
//                 $('.hideselectsemesterfirst').attr("hidden", "true");

//                 $('.hideselectyearfirst').attr("hidden", "true");
//                 $('.hideselectyearsecond').attr("hidden", "true");
//                 $('.hideselectyearthird').attr("hidden", "true");
//             }
//         });
//     });
//     When a add button is clicked event

//     $("#addfacultybutton").click(function () {
//         $('.addfacultyform').removeAttr("hidden");
//     });


// $(document).ready(function(){

//  fetch_customer_data();

//  function fetch_customer_data(query = '')
//  {
//   $.ajax({
//    url:"{{ route('live_search.action') }}",
//    method:'GET',
//    data:{query:query},
//    contentType: "application/json",
//    dataType:'json',
//    success:function(data)
//    {
//     $('tbody').html(data.table_data);
//     $('#total_records').text(data.total_data);
//     var x=(data.table_data);

//    }
//   })
//  }

//  $(document).on('keyup', '#search', function(){
//   var query = $(this).val();
//   fetch_customer_data(query);
//  });
// });
//  -->

<script>
    $("#addfacultybutton").click(function () {
        $('.addfacultyform').removeAttr("hidden");
    });

    $("#dialog").dialog({
        autoOpen: false
    });
    $("#btnExample").click(function () {
        $("#dialog").dialog("open");
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
