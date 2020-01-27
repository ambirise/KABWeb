@extends('home')
@section('content')
<div class="container">
    <div class="card mt-4">
        <div class="card-header text-center">
            <h5>Insert Faculty</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('faculties.store') }}" method="POST" enctype="mutipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-4">
                        <span style="font-size:16px;">Choose Level</span><br>
                        <select class="custom-select getlevelname" name="levelchoose" style="height:38px;width:182px;"
                            id="customchange" required>
                            <option value="" selected>Select Level</option>
                            <option value="{{$get_school}}">School</option>
                            <option value="{{$get_bachelor}}">Bachelor</option>
                            <option value="{{$get_10plus2}}">10+2</option>
                            <option value="{{$get_loksewa}}">Loksewa</option>
                        </select>
                    </div>
                    <div class="col-md-4 hidefaculty" hidden="true">
                        <span style="font-size:16px;">Add Faculty</span>
                        <input type="text" name="faculty" class="form-control" id="usr" style="width:182px;"><br>
                    </div>
                    <div class="col-md-4 hideclass" hidden="true">
                        <span style="font-size:16px;">Add Class</span>
                        <input type="text" name="faculty" class="form-control" id="usr" style="width:182px;"><br>
                    </div>

                    <div class="col-md-4 hidesemesterandyear" hidden="true">
                        <span style="font-size:16px;">Choose Semester or Year</span>

                        <div>
                            <label class="btn btn-light">
                                <input type="radio" name="Semester" Value="0" autocomplete="off">
                                Semester
                            </label>
                            <label class="btn btn-light">
                                <input type="radio" name="Semester" value="1" autocomplete="off"> Year
                            </label>
                        </div>
                    </div>
                    <div class="col-md-4 hideyears" hidden="true">
                        <span style="font-size:16px;">Number of Years</span>

                        <div>
                            <label class="btn btn-light">
                                <input type="radio" name="numberofyear" Value="three" autocomplete="off" >
                                Three
                            </label>
                            <label class="btn btn-light">
                                <input type="radio" name="numberofyear" value="four" autocomplete="off">Four
                            </label>
                            <label class="btn btn-light">
                                <input type="radio" name="numberofyear" value="five" autocomplete="off">Five
                            </label>
                        </div>
                    </div>

                    <div class="col-md-4 hidesemesters" hidden="true">
                        <span style="font-size:16px;">Number of Semesters</span>

                        <div>
                            <label class="btn btn-light">
                                <input type="radio" name="numberofsemester" Value="six" autocomplete="off">
                                Six
                            </label>
                            <label class="btn btn-light">
                                <input type="radio" name="numberofsemester" value="eight" autocomplete="off">Eight
                            </label>
                            <label class="btn btn-light">
                                <input type="radio" name="numberofsemester" value="ten" autocomplete="off">Ten
                            </label>
                        </div>
                    </div>


                    <div class="col-md-4 hideselectyearfirst" hidden="true">
                        <span style="font-size:16px;">Select Year</span><br>
                        <select class="custom-select" name="year" style="height:38px;width:182px;" id="customchange"
                            required>
                            <option value="1" selected>First</option>
                            <option value="2">Second</option>
                            <option value="3">Third</option>
                        </select>
                    </div>



                    <div class="col-md-4 hideselectyearsecond" hidden="true">

                        <span style="font-size:16px;">Select Year</span><br>
                        <select class="custom-select" name="year" style="height:38px;width:182px;" id="customchange"
                            required>
                            <option value="1" selected>First</option>
                            <option value="2">Second</option>
                            <option value="3">Third</option>
                            <option value="4">Fourth</option>
                        </select>

                    </div>

                    <div class="col-md-4 hideselectyearthird" hidden="true">

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

                    <div class="col-md-4 hideselectsemesterfirst" hidden="true">
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

                    <div class="col-md-4 hideselectsemestersecond" hidden="true">

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
                    <div class="col-md-4 hideselectsemesterthird" hidden="true">

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

                    </div>

                    <div class="col-md-4"><br>
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
            <h5>Show Details</h5>
        </div>
        <div class="card-body">
            <table class="table mt-0">
                <thead>
                    <tr>
                        <th scope="col">S.N</th>
                        <th scope="col">Faculty Title</th>
                        <th scope="col">Level</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($get_faculty_data as $key => $faculty_data)
                    <tr>
                        <th scope="row">{{$key+1}}</th>
                        <td>{{$faculty_data->faculty_title}}</td>
                        <td>{{$faculty_data->level_title}}</td>
                        <td><a href="{{ route('editfacultiesDetails', $faculty_data->faculty_id)}}"><button
                                    class="btn btn-primary">Edit</button></a>
                            <form action="{{ route('faculties.destroy', $faculty_data->faculty_id)}}" method="POST"
                                style="display: inline;">{{ method_field('DELETE') }}{{ csrf_field() }}<button
                                    class="btn btn-danger">Delete</button></form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('input:radio[name="Semester"]').change(function () {
            if ($(this).val() == '1') {
                $('.hideyears').removeAttr('hidden');
                $('.hidesemesters').attr("hidden", "false");

                $('.hideselectyearfirst').attr("hidden", "true");
                $('.hideselectyearsecond').attr("hidden", "true");
                $('.hideselectyearthird').attr("hidden", "true");

                $('.hideselectsemesterfirst').attr("hidden", "true");
                $('.hideselectsemestersecond').attr("hidden", "true");
                $('.hideselectsemesterthird').attr("hidden", "true");
            }

            if ($(this).val() == '0') {
                $('.hidesemesters').removeAttr('hidden');
                $('.hideyears').attr("hidden", "false");

                $('.hideselectyearfirst').attr("hidden", "true");
                $('.hideselectyearsecond').attr("hidden", "true");
                $('.hideselectyearthird').attr("hidden", "true");

                $('.hideselectsemesterfirst').attr("hidden", "true");
                $('.hideselectsemestersecond').attr("hidden", "true");
                $('.hideselectsemesterthird').attr("hidden", "true");
            }
        });

    });
    $(document).ready(function () {
        $("select.getlevelname").change(function () {
            if ($(this).val() == '1') {
                $('.hideclass').removeAttr("hidden");
                $('.hidefaculty').attr("hidden", "true");
                $('.hidesemesterandyear').attr("hidden", "true");
                $('.hideyears').attr("hidden", "true");
                $('.hidesemesters').attr("hidden", "true");
                $('.hideselectyearfirst').attr("hidden", "true");
                $('.hideselectyearsecond').attr("hidden", "true");
                $('.hideselectyearthird').attr("hidden", "true");

                $('.hideselectsemesterfirst').attr("hidden", "true");
                $('.hideselectsemestersecond').attr("hidden", "true");
                $('.hideselectsemesterthird').attr("hidden", "true");
            }
            if ($(this).val() == '3') {
                $('.hidefaculty').removeAttr("hidden");
                $('.hideclass').attr("hidden", "true");
                $('.hidesemesterandyear').removeAttr("hidden");
                $('.hideyears').attr("hidden", "true");
                $('.hidesemesters').attr("hidden", "true");

                $('.hideselectsemesterfirst').attr("hidden", "true");
                $('.hideselectsemestersecond').attr("hidden", "true");
                $('.hideselectsemesterthird').attr("hidden", "true");
            }
            if ($(this).val() == '4') {
                $('.hideclass').removeAttr("hidden");
                $('.hidefaculty').attr("hidden", "true");
                $('.hidesemesterandyear').attr("hidden", "true");
                $('.hideyears').attr("hidden", "true");
                $('.hidesemesters').attr("hidden", "true");
                $('.hideselectyearfirst').attr("hidden", "true");
                $('.hideselectyearsecond').attr("hidden", "true");
                $('.hideselectyearthird').attr("hidden", "true");

                $('.hideselectsemesterfirst').attr("hidden", "true");
                $('.hideselectsemestersecond').attr("hidden", "true");
                $('.hideselectsemesterthird').attr("hidden", "true");
            }
            if ($(this).val() == '5') {
                $('.hidefaculty').removeAttr("hidden");
                $('.hideclass').attr("hidden", "true");
                $('.hidesemesterandyear').attr("hidden", "true");
                $('.hideyears').attr("hidden", "true");
                $('.hidesemesters').attr("hidden", "true");
                $('.hideselectyearfirst').attr("hidden", "true");
                $('.hideselectyearsecond').attr("hidden", "true");
                $('.hideselectyearthird').attr("hidden", "true");

                $('.hideselectsemesterfirst').attr("hidden", "true");
                $('.hideselectsemestersecond').attr("hidden", "true");
                $('.hideselectsemesterthird').attr("hidden", "true");
            }
        });
    });

    $(document).ready(function () {
        $('input:radio[name="numberofyear"]').change(function () {
            if ($(this).val() == 'three') {
                $('.hideselectyearfirst').removeAttr("hidden");
                $('.hideselectyearsecond').attr("hidden", "true");
                $('.hideselectyearthird').attr("hidden", "true");

                $('.hideselectsemesterfirst').attr("hidden", "true");
                $('.hideselectsemestersecond').attr("hidden", "true");
                $('.hideselectsemesterthird').attr("hidden", "true");
            }

            if ($(this).val() == 'four') {
                $('.hideselectyearsecond').removeAttr("hidden");
                $('.hideselectyearfirst').attr("hidden", "true");
                $('.hideselectyearthird').attr("hidden", "true");

                $('.hideselectsemesterfirst').attr("hidden", "true");
                $('.hideselectsemestersecond').attr("hidden", "true");
                $('.hideselectsemesterthird').attr("hidden", "true");
            }

            if ($(this).val() == 'five') {
                $('.hideselectyearthird').removeAttr("hidden");
                $('.hideselectyearsecond').attr("hidden", "true");
                $('.hideselectyearfirst').attr("hidden", "true");

                $('.hideselectsemesterfirst').attr("hidden", "true");
                $('.hideselectsemestersecond').attr("hidden", "true");
                $('.hideselectsemesterthird').attr("hidden", "true");
            }
        });

    });

    $(document).ready(function () {
        $('input:radio[name="numberofsemester"]').change(function () {
            if ($(this).val() == 'six') {
                $('.hideselectsemesterfirst').removeAttr("hidden");
                $('.hideselectsemestersecond').attr("hidden", "true");
                $('.hideselectsemesterthird').attr("hidden", "true");

                $('.hideselectyearfirst').attr("hidden", "true");
                $('.hideselectyearsecond').attr("hidden", "true");
                $('.hideselectyearthird').attr("hidden", "true");
            }

            if ($(this).val() == 'eight') {
                $('.hideselectsemestersecond').removeAttr("hidden");
                $('.hideselectsemesterfirst').attr("hidden", "true");
                $('.hideselectsemesterthird').attr("hidden", "true");

                $('.hideselectyearfirst').attr("hidden", "true");
                $('.hideselectyearsecond').attr("hidden", "true");
                $('.hideselectyearthird').attr("hidden", "true");
            }

            if ($(this).val() == 'ten') {
                $('.hideselectsemesterthird').removeAttr("hidden");
                $('.hideselectsemestersecond').attr("hidden", "true");
                $('.hideselectsemesterfirst').attr("hidden", "true");

                $('.hideselectyearfirst').attr("hidden", "true");
                $('.hideselectyearsecond').attr("hidden", "true");
                $('.hideselectyearthird').attr("hidden", "true");
            }
        });

    });

</script>
@endsection
