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
                                @if($get_semester_data->yearorsemester == "s" && $get_semester_data->numberofsemester ==
                                "6")
                                <span style="font-size:16px;">Select Semester</span><br>
                                <select class="custom-select" name="year" style="height:38px;width:182px;"
                                    id="customchange" required>
                                    @if($get_semester_data->semester_title == "1s")
                                    <option value="1s" selected>First</option>
                                    @else
                                    <option value="1s">First</option>
                                    @endif

                                    @if($get_semester_data->semester_title == "2s")
                                    <option value="2s" selected>Second</option>
                                    @else
                                    <option value="2s">Second</option>
                                    @endif


                                    @if($get_semester_data->semester_title == "3s")
                                    <option value="3s" selected>Third</option>
                                    @else
                                    <option value="3s">Third</option>
                                    @endif

                                    @if($get_semester_data->semester_title == "4s")
                                    <option value="4s" selected>Fourth</option>
                                    @else
                                    <option value="4s">Fourth</option>
                                    @endif

                                    @if($get_semester_data->semester_title == "5s")
                                    <option value="5s" selected>Fifth</option>
                                    @else
                                    <option value="5s">Fifth</option>
                                    @endif

                                    @if($get_semester_data->semester_title == "6s")
                                    <option value="6s" selected>Sixth</option>
                                    @else
                                    <option value="6s">Sixth</option>
                                    @endif
                                </select>
                                @endif

                                @if($get_semester_data->yearorsemester == "s" && $get_semester_data->numberofsemester ==
                                "8")
                                <span style="font-size:16px;">Select Semester</span><br>
                                <select class="custom-select" name="year" style="height:38px;width:182px;"
                                    id="customchange" required>
                                    @if($get_semester_data->semester_title == "1s")
                                    <option value="1s" selected>First</option>
                                    @else
                                    <option value="1s">First</option>
                                    @endif

                                    @if($get_semester_data->semester_title == "2s")
                                    <option value="2s" selected>Second</option>
                                    @else
                                    <option value="2s">Second</option>
                                    @endif


                                    @if($get_semester_data->semester_title == "3s")
                                    <option value="3s" selected>Third</option>
                                    @else
                                    <option value="3s">Third</option>
                                    @endif

                                    @if($get_semester_data->semester_title == "4s")
                                    <option value="4s" selected>Fourth</option>
                                    @else
                                    <option value="4s">Fourth</option>
                                    @endif

                                    @if($get_semester_data->semester_title == "5s")
                                    <option value="5s" selected>Fifth</option>
                                    @else
                                    <option value="5s">Fifth</option>
                                    @endif

                                    @if($get_semester_data->semester_title == "6s")
                                    <option value="6s" selected>Sixth</option>
                                    @else
                                    <option value="6s">Sixth</option>
                                    @endif

                                    @if($get_semester_data->semester_title == "7s")
                                    <option value="7s" selected>Seventh</option>
                                    @else
                                    <option value="7s">Seventh</option>
                                    @endif

                                    @if($get_semester_data->semester_title == "8s")
                                    <option value="8s" selected>Eighth</option>
                                    @else
                                    <option value="8s">Eighth</option>
                                    @endif
                                </select>
                                @endif

                                @if($get_semester_data->yearorsemester == "s" && $get_semester_data->numberofsemester ==
                                "10")
                                <span style="font-size:16px;">Select Semester</span><br>
                                <select class="custom-select" name="year" style="height:38px;width:182px;"
                                    id="customchange" required>
                                    @if($get_semester_data->semester_title == "1s")
                                    <option value="1s" selected>First</option>
                                    @else
                                    <option value="1s">First</option>
                                    @endif

                                    @if($get_semester_data->semester_title == "2s")
                                    <option value="2s" selected>Second</option>
                                    @else
                                    <option value="2s">Second</option>
                                    @endif


                                    @if($get_semester_data->semester_title == "3s")
                                    <option value="3s" selected>Third</option>
                                    @else
                                    <option value="3s">Third</option>
                                    @endif

                                    @if($get_semester_data->semester_title == "4s")
                                    <option value="4s" selected>Fourth</option>
                                    @else
                                    <option value="4s">Fourth</option>
                                    @endif

                                    @if($get_semester_data->semester_title == "5s")
                                    <option value="5s" selected>Fifth</option>
                                    @else
                                    <option value="5s">Fifth</option>
                                    @endif

                                    @if($get_semester_data->semester_title == "6s")
                                    <option value="6s" selected>Sixth</option>
                                    @else
                                    <option value="6s">Sixth</option>
                                    @endif

                                    @if($get_semester_data->semester_title == "7s")
                                    <option value="7s" selected>Seventh</option>
                                    @else
                                    <option value="7s">Seventh</option>
                                    @endif

                                    @if($get_semester_data->semester_title == "8s")
                                    <option value="8s" selected>Eighth</option>
                                    @else
                                    <option value="8s">Eighth</option>
                                    @endif

                                    @if($get_semester_data->semester_title == "9s")
                                    <option value="9s" selected>Eighth</option>
                                    @else
                                    <option value="9s">Eighth</option>
                                    @endif

                                    @if($get_semester_data->semester_title == "10s")
                                    <option value="10s" selected>Eighth</option>
                                    @else
                                    <option value="10s">Eighth</option>
                                    @endif

                                </select>
                                @endif

                                @if($get_semester_data->yearorsemester == "y" && $get_semester_data->numberofyear ==
                                "3")
                                <span style="font-size:16px;">Select Year</span><br>
                                <select class="custom-select" name="year" style="height:38px;width:182px;"
                                    id="customchange" required>
                                    <option value="1y" selected>First</option>
                                    <option value="2y">Second</option>
                                    <option value="3y">Third</option>
                                </select>
                                @endif

                                @if($get_semester_data->yearorsemester == "y" && $get_semester_data->numberofyear ==
                                "4")
                                <span style="font-size:16px;">Select Year</span><br>
                                <select class="custom-select" name="year" style="height:38px;width:182px;"
                                    id="customchange" required>
                                    <option value="1y" selected>First</option>
                                    <option value="2y">Second</option>
                                    <option value="3y">Third</option>
                                    <option value="4y">Fourth</option>
                                </select>
                                @endif

                                @if($get_semester_data->yearorsemester == "y" && $get_semester_data->numberofyear ==
                                "5")
                                <span style="font-size:16px;">Select Year</span><br>
                                <select class="custom-select" name="year" style="height:38px;width:182px;"
                                    id="customchange" required>
                                    <option value="1y" selected>First</option>
                                    <option value="2y">Second</option>
                                    <option value="3y">Third</option>
                                    <option value="4y">Fourth</option>
                                    <option value="5y">Fifth</option>
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
                                <a href="{{ route('getsubjectsIndex',$get_subject_data->faculty_id) }}"><button type="button" class="btn btn-primary">Cancel</button></a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
