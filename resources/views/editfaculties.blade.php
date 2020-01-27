@extends('home')
@section('content')

<script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>

<main class="page-content" style="font-family: Times New Roman, Times, serif;">
    <form action="{{ route('faculties.update',$facultiesdetails->faculty_id) }}" method="POST" enctype="mutipart/form-data">
        {{ method_field('PUT') }}
        {{ csrf_field() }}
        <div class="row">
            <div class="col-md-4">
                <span style="font-size:16px;">Choose Level</span><br>
                <select class="custom-select" name="levelchoose" style="height:38px;width:182px;" id="customchange"
                    required>
                    <option value="" selected>Select Level</option>
                    <option value="{{$get_school}}">School</option>
                    <option value="{{$get_bachelor}}">Bachelor</option>
                    <option value="{{$get_10plus2}}">10+2</option>
                    <option value="{{$get_loksewa}}">Loksewa</option>
                </select>
            </div>
            <div class="col-md-4">
                <span style="font-size:16px;">Add Faculty</span>

                <input type="text" name="faculty" class="form-control" id="usr" style="width:182px;"><br>
            </div>
            <div class="col-md-4"><br>
                <button type="submit" class="btn btn-primary">ADD</button>
            </div>
        </div>
    </form>
</main>
@endsection
