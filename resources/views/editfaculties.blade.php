@extends('home')
@section('content')

<br>
<div class="container">
    <h5> Edit Faculties: </h5>
    <br>
    <main class="page-content" style="font-family: Times New Roman, Times, serif;">
        <form action="{{ route('facultiesUpdate', $facultiesdetails->faculty_id)}}"method="POST" enctype="mutipart/form-data">
        
            {{ csrf_field() }}
            <div class="row">
               <!-- for levels page -->
                <!-- <div class="col-md-4">
                    <span style="font-size:16px;">Level</span><br>
                    <select class="custom-select" name="levelchoose" style="height:38px;width:182px;" id="customchange"
                        disabled>
                        <option value="{{$implode_leveldetailsid}}" selected>{{$implode_leveldetailstitle}}</option>
                        <option value="{{$get_school}}">School</option>
                        <option value="{{$get_bachelor}}">Bachelor</option>
                        <option value="{{$get_10plus2}}">10+2</option>
                        <option value="{{$get_loksewa}}">Loksewa</option>
                    </select>
                </div> -->

                @if($implode_leveldetailstitle=="Bachelor")
                <div class="col-md-4">
                    <span style="font-size:16px;">Add Faculty</span>
                    <input type="text" name="facultybachelor" value="{{$facultiesdetails_faculty->faculty_title}}"  class="form-control"
                        id="usr" style="width:182px;"><br>
                </div>

                <div class="col-md-4 hidesemesterandyear">
                    <span style="font-size:16px;">Choose Semester or Year</span>
                    <div>
                        @if($facultiesdetails->yearorsemester=="s")
                        <label class="btn btn-light">
                            <input type="radio" name="Semester" Value="s" autocomplete="off" checked>
                            Semester
                        </label>
                        <label class="btn btn-light">
                            <input type="radio" name="Semester" value="y" autocomplete="off"> Year
                        </label>
                        @else
                        <label class="btn btn-light">
                            <input type="radio" name="Semester" Value="s" autocomplete="off">
                            Semester
                        </label>
                        <label class="btn btn-light">
                            <input type="radio" name="Semester" value="y" autocomplete="off" checked> Year
                        </label>

                        @endif
                    </div>
                </div>

                @if( !empty($facultiesdetails->numberofyear))
                <div class="col-md-4 hideyears">
                    <span style="font-size:16px;">Number of Years</span>
                    <div>
                        @if($facultiesdetails->numberofyear=="3")
                        <label class="btn btn-light">
                            <input type="radio" name="numberofyear" Value="3" autocomplete="off" checked>
                            Three
                        </label>
                        <label class="btn btn-light">
                            <input type="radio" name="numberofyear" value="4" autocomplete="off">Four
                        </label>
                        <label class="btn btn-light">
                            <input type="radio" name="numberofyear" value="5" autocomplete="off">Five
                        </label>
                        @endif
                        @if($facultiesdetails->numberofyear=="4")
                        <label class="btn btn-light">
                            <input type="radio" name="numberofyear" Value="3" autocomplete="off">
                            Three
                        </label>
                        <label class="btn btn-light">
                            <input type="radio" name="numberofyear" value="4" autocomplete="off" checked>Four
                        </label>
                        <label class="btn btn-light">
                            <input type="radio" name="numberofyear" value="5" autocomplete="off">Five
                        </label>
                        @endif
                        @if($facultiesdetails->numberofyear=="5")
                        <label class="btn btn-light">
                            <input type="radio" name="numberofyear" Value="3" autocomplete="off">
                            Three
                        </label>
                        <label class="btn btn-light">
                            <input type="radio" name="numberofyear" value="4" autocomplete="off">Four
                        </label>
                        <label class="btn btn-light">
                            <input type="radio" name="numberofyear" value="5" autocomplete="off" checked>Five
                        </label>
                        @endif
                    </div>
                </div>
                @endif

                @if( !empty($facultiesdetails->numberofsemester))
                <div class="col-md-4 hidesemesters">
                    <span style="font-size:16px;">Number of Semesters</span>
                    <div>
                        @if($facultiesdetails->numberofsemester=="6")
                        <label class="btn btn-light">
                            <input type="radio" name="numberofsemester" Value="6" autocomplete="off" checked>
                            Six
                        </label>
                        <label class="btn btn-light">
                            <input type="radio" name="numberofsemester" value="8" autocomplete="off">Eight
                        </label>
                        <label class="btn btn-light">
                            <input type="radio" name="numberofsemester" value="10" autocomplete="off">Ten
                        </label>
                        @endif
                        @if($facultiesdetails->numberofsemester=="8")
                        <label class="btn btn-light">
                            <input type="radio" name="numberofsemester" Value="6" autocomplete="off">
                            Six
                        </label>
                        <label class="btn btn-light">
                            <input type="radio" name="numberofsemester" value="8" autocomplete="off" checked>Eight
                        </label>
                        <label class="btn btn-light">
                            <input type="radio" name="numberofsemester" value="10" autocomplete="off">Ten
                        </label>
                        @endif
                        @if($facultiesdetails->numberofsemester=="10")
                        <label class="btn btn-light">
                            <input type="radio" name="numberofsemester" Value="6" autocomplete="off">
                            Six
                        </label>
                        <label class="btn btn-light">
                            <input type="radio" name="numberofsemester" value="8" autocomplete="off">Eight
                        </label>
                        <label class="btn btn-light">
                            <input type="radio" name="numberofsemester" value="10" autocomplete="off" checked>Ten
                        </label>
                        @endif
                    </div>
                </div>
                @endif

                @else
                <div class="col-md-4 hidefaculty">
                    <span style="font-size:16px;">Add School</span>
                    <input type="text" name="facultybachelor" value="{{$facultiesdetails->faculty_title}}" class="form-control" id="usr" style="width:182px;"><br>
                </div>
                @endif

                <div class="col-md-4"><br>
                    <button type="submit" class="btn btn-primary" onclick="window.close(); window.opener.location.reload();">Update</button>
                </div>
            </div>
        </form>
    </main>
</div>
@endsection
