@extends('home')
@section('content')

<div class="container">
    <div class="card mt-4">
        <div class="card-header">
            <h5>Update Chapter</h5>
        </div>
        <div class="card-body">
            <div class="card mt-4 addchapterform">
                <div class="card-body">
                    <form action="{{route('chaptersUpdate',$get_chapter_data->chapter_id)}}" onSubmit="
            window.opener.location.reload();" method="POST" id="updateformchapter" enctype="mutipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="col-md-4">
                                    <span style="font-size:16px;">Chapter</span>
                                    <input type="text" name="chapter" value="{{$get_chapter_data->chapter_title}}"
                                        class="form-control" id="usr" style="width:260px;"><br>
                                </div>
                            </div>
                            <div class="col-md-6"><br>
                                <button type="submit" class="btn btn-primary" onclick="Update()">UPDATE</button>
                                <a href="{{ route('getchaptersIndex',$get_chapter_data->subject_id) }}"><button type="button" class="btn btn-primary">Cancel</button></a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- <script>
    function Update() {
        if (document.getElementById('updateformchapter').submit() = true) {
            window.close();
            window.opener.location.reload();
        }
    }

</script> -->
@endsection
