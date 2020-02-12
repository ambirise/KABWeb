@extends('home')
@section('content')

<div class="container">
    <div class="card mt-4 addchapterform" >
        <div class="card-body">
            <form action="{{route('chaptersUpdate',$get_chapter_data->chapter_id)}}" method="POST" enctype="mutipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="col-md-4">
                            <span style="font-size:16px;">Chapter</span>
                            <input type="text" name="chapter" value="{{$get_chapter_data->chapter_title}}" class="form-control" id="usr" style="width:182px;"><br>
                        </div>
                    </div>
                    <div class="col-md-6"><br>
                        <button type="submit" class="btn btn-primary" onclick="window.close(); window.opener.location.reload();">UPDATE</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
