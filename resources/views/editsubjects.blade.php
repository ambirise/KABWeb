@extends('home')
@section('content')

<div class="container">
    <div class="card mt-4">
        <div class="card-header">
            <h5>Update Subject</h5>
        </div>
        <div class="card-body">
            <form action="{{route('subjectsUpdate',$get_subject_data->subject_id)}}" method="POST" onSubmit="
            window.opener.location.reload();" id="updateformsubject" enctype="mutipart/form-data">
                <div class="card mt-2 addsubjectform">
                    <div class="card-body" style="padding:8px;">
                        @csrf
                        <div class="row">
                            @if((!empty($get_semester_data->yearorsemester)))
                            <div class="col-md-6">

                                @if($get_semester_data->yearorsemester == "y" && $get_semester_data->numberofyear ==
                                "2")
                                <div class="col-md-6">
                                    <span style="font-size:16px;">Select Year</span><br>
                                    <select class="custom-select" name="year" style="height:38px;width:182px;"
                                        id="customchange" required>
                                        <option value="First Year" selected>First</option>
                                        <option value="Second Year">Second</option>
                                    </select>
                                </div>
                                @endif


                                @if($get_semester_data->yearorsemester == "s" && $get_semester_data->numberofsemester ==
                                "6")
                                <span style="font-size:16px;">Select Semester</span><br>
                                <select class="custom-select" name="year" style="height:38px;width:182px;"
                                    id="customchange" required>
                                    @if($get_semester_data->semester_title == "First Semester")
                                    <option value="First Semester" selected>First</option>
                                    @else
                                    <option value="First Semester">First</option>
                                    @endif

                                    @if($get_semester_data->semester_title == "Second Semester")
                                    <option value="Second Semester" selected>Second</option>
                                    @else
                                    <option value="Second Semester">Second</option>
                                    @endif


                                    @if($get_semester_data->semester_title == "Third Semester")
                                    <option value="Third Semester" selected>Third</option>
                                    @else
                                    <option value="Third Semester">Third</option>
                                    @endif

                                    @if($get_semester_data->semester_title == "Fourth Semester")
                                    <option value="Fourth Semester" selected>Fourth</option>
                                    @else
                                    <option value="Fourth Semester">Fourth</option>
                                    @endif

                                    @if($get_semester_data->semester_title == "Fifth Semester")
                                    <option value="Fifth Semester" selected>Fifth</option>
                                    @else
                                    <option value="Fifth Semester">Fifth</option>
                                    @endif

                                    @if($get_semester_data->semester_title == "Sixth Semester")
                                    <option value="Sixth Semester" selected>Sixth</option>
                                    @else
                                    <option value="Sixth Semester">Sixth</option>
                                    @endif
                                </select>
                                @endif

                                @if($get_semester_data->yearorsemester == "s" && $get_semester_data->numberofsemester ==
                                "8")
                                <span style="font-size:16px;">Select Semester</span><br>
                                <select class="custom-select" name="year" style="height:38px;width:182px;"
                                    id="customchange" required>
                                    @if($get_semester_data->semester_title == "First Semester")
                                    <option value="First Semester" selected>First</option>
                                    @else
                                    <option value="First Semester">First</option>
                                    @endif

                                    @if($get_semester_data->semester_title == "Second Semester")
                                    <option value="Second Semester" selected>Second</option>
                                    @else
                                    <option value="Second Semester">Second</option>
                                    @endif

                                    @if($get_semester_data->semester_title == "Third Semester")
                                    <option value="Third Semester" selected>Third</option>
                                    @else
                                    <option value="Third Semester">Third</option>
                                    @endif

                                    @if($get_semester_data->semester_title == "Fourth Semester")
                                    <option value="Fourth Semester" selected>Fourth</option>
                                    @else
                                    <option value="Fourth Semester">Fourth</option>
                                    @endif

                                    @if($get_semester_data->semester_title == "Fifth Semester")
                                    <option value="Fifth Semester" selected>Fifth</option>
                                    @else
                                    <option value="Fifth Semester">Fifth</option>
                                    @endif

                                    @if($get_semester_data->semester_title == "Sixth Semester")
                                    <option value="Sixth Semester" selected>Sixth</option>
                                    @else
                                    <option value="Sixth Semester">Sixth</option>
                                    @endif

                                    @if($get_semester_data->semester_title == "Seventh Semester")
                                    <option value="Seventh Semester" selected>Seventh</option>
                                    @else
                                    <option value="Seventh Semester">Seventh</option>
                                    @endif

                                    @if($get_semester_data->semester_title == "Eighth Semester")
                                    <option value="Eighth Semester" selected>Eighth</option>
                                    @else
                                    <option value="Eighth Semester">Eighth</option>
                                    @endif
                                </select>
                                @endif

                                @if($get_semester_data->yearorsemester == "s" && $get_semester_data->numberofsemester ==
                                "10")
                                <span style="font-size:16px;">Select Semester</span><br>
                                <select class="custom-select" name="year" style="height:38px;width:182px;"
                                    id="customchange" required>
                                    @if($get_semester_data->semester_title == "First Semester")
                                    <option value="First Semester" selected>First</option>
                                    @else
                                    <option value="First Semester">First</option>
                                    @endif

                                    @if($get_semester_data->semester_title == "Second Semester")
                                    <option value="Second Semester" selected>Second</option>
                                    @else
                                    <option value="Second Semester">Second</option>
                                    @endif


                                    @if($get_semester_data->semester_title == "Third Semester")
                                    <option value="Third Semester" selected>Third</option>
                                    @else
                                    <option value="Third Semester">Third</option>
                                    @endif

                                    @if($get_semester_data->semester_title == "Fourth Semester")
                                    <option value="Fourth Semester" selected>Fourth</option>
                                    @else
                                    <option value="Fourth Semester">Fourth</option>
                                    @endif

                                    @if($get_semester_data->semester_title == "Fifth Semester")
                                    <option value="Fifth Semester" selected>Fifth</option>
                                    @else
                                    <option value="Fifth Semester">Fifth</option>
                                    @endif

                                    @if($get_semester_data->semester_title == "Sixth Semester")
                                    <option value="Sixth Semester" selected>Sixth</option>
                                    @else
                                    <option value="Sixth Semester">Sixth</option>
                                    @endif

                                    @if($get_semester_data->semester_title == "Seventh Semester")
                                    <option value="Seventh Semester" selected>Seventh</option>
                                    @else
                                    <option value="Seventh Semester">Seventh</option>
                                    @endif

                                    @if($get_semester_data->semester_title == "Eighth Semester")
                                    <option value="Eighth Semester" selected>Eighth</option>
                                    @else
                                    <option value="Eighth Semester">Eighth</option>
                                    @endif

                                    @if($get_semester_data->semester_title == "Nineth Semester")
                                    <option value="Nineth Semester" selected>Eighth</option>
                                    @else
                                    <option value="Nineth Semester">Eighth</option>
                                    @endif

                                    @if($get_semester_data->semester_title == "Ten Semester")
                                    <option value="Tenth Semester" selected>Eighth</option>
                                    @else
                                    <option value="Tenth Semester">Eighth</option>
                                    @endif

                                </select>
                                @endif

                                @if($get_semester_data->yearorsemester == "y" && $get_semester_data->numberofyear ==
                                "3")
                                <span style="font-size:16px;">Select Year</span><br>
                                <select class="custom-select" name="year" style="height:38px;width:182px;"
                                    id="customchange" required>
                                    <option value="First Year" selected>First</option>
                                    <option value="Second Year">Second</option>
                                    <option value="Third Year">Third</option>
                                </select>
                                @endif

                                @if($get_semester_data->yearorsemester == "y" && $get_semester_data->numberofyear ==
                                "4")
                                <span style="font-size:16px;">Select Year</span><br>
                                <select class="custom-select" name="year" style="height:38px;width:182px;"
                                    id="customchange" required>
                                    <option value="First Year" selected>First</option>
                                    <option value="Second Year">Second</option>
                                    <option value="Third Year">Third</option>
                                    <option value="Fourth Year">Fourth</option>
                                </select>
                                @endif

                                @if($get_semester_data->yearorsemester == "y" && $get_semester_data->numberofyear ==
                                "5")
                                <span style="font-size:16px;">Select Year</span><br>
                                <select class="custom-select" name="year" style="height:38px;width:182px;"
                                    id="customchange" required>
                                    <option value="First Year" selected>First</option>
                                    <option value="Second Year">Second</option>
                                    <option value="Third Year">Third</option>
                                    <option value="Fourth Year">Fourth</option>
                                    <option value="Fifth Year">Fifth</option>
                                </select>
                                @endif
                            </div>
                            @endif

                            <div class="col-md-6">
                                <span style="font-size:16px;">Subject</span>
                                <input type="text" name="subject" value="{{$get_subject_data->subject_title}}"
                                    class="form-control input-sm" id="usr" style="width:260px;"><br>
                            </div>
                            <div class="col-md-6"><br>
                                <button type="submit" onclick="Update()" class="btn btn-primary">UPDATE</button>
                                <a href="{{ route('getsubjectsIndex',$get_subject_data->faculty_id) }}"><button
                                        type="button" class="btn btn-primary">Cancel</button></a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
