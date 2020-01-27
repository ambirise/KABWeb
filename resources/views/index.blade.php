@extends('home')
@section('content')
<div class="container">
    <div class="card mt-4">
        <div class="card-header text-center">
            <h5>Insert Audio Books</h5>
        </div>
        <div class="card-body">
            <div>
                <span style="font-size:16px;">Choose Level</span><br>
                <select class="custom-select" name="" style="height:38px;width:182px;" id="customchange" required>
                    <option value="" selected>Select Level</option>
                    <option value="{{$get_school}}">School</option>
                    <option value="{{$get_bachelor}}">Bachelor</option>
                    <option value="{{$get_10plus2}}">10+2</option>
                    <option value="{{$get_loksewa}}">Loksewa</option>
                </select>
                <br><br>
                <span style="font-size:16px;">Add Faculty</span>&nbsp;

                <input type="text" class="form-control" id="usr" style="width:182px;">

            </div>
        </div>
    </div>
</div>

@endsection
