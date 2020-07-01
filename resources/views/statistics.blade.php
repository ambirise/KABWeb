@extends('home')
@section('content')

<br>
<div class="container">
   <h5 class="text-center">Registered Students Details</h5><br>
    <!-- <h5 class="text-center">Please Select an Option To Sort</h5><br>
    <div class="row text-center">
        <div class="col-md-6 ">
            <div>Name </div>
            <div>
                @if(isset($sortbyname))
                <label class="btn btn-light">
                    <input type="radio" name="optradio1" autocomplete="off" checked="checked" id="sortbyname" value="1">
                    By Name
                </label>
                @else
                <label class="btn btn-light">
                    <input type="radio" name="optradio1" autocomplete="off" id="sortbyname" value="1">
                    By Name
                </label>
                @endif
            </div>
        </div>

         <div class="col-md-2">
            <div>Age</div>
            <div>
                <form action="{{route('sortbylevel')}}" method="POST" enctype="mutipart/form-data">
                @csrf
                    <div class="form-row">
                        <div class="col">
                            <input type="text" name="level" class="form-control" placeholder="From">
                        </div>
                    </div>
                    <button type="submit"  class="btn btn-primary mb-2 mt-1 pt-0">Sort by Level</button>
                </form>
            </div>
        </div>
    </div> -->
   
    <a href="{{ url('/export') }}"><button type="button" class="btn btn-primary pt-0" style="float:right;">Download as
            Excel</button></a>
    <br><br>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">S.N</th>
                <th scope="col">Name</th>
                <th scope="col">Phone</th>
                <th scope="col">Level</th>
            </tr>
        </thead>
        <tbody>
            @foreach($statistics as $key=>$data)
            <tr>
                <th scope="row">{{$key+1}}</th>
                <td>{{$data->name}}</td>
                <td>{{$data->phone}}</td>
                <td>{{$data->level}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script>
    $("[name=optradio1]").on("click", function (event) {
        //  alert("Hello! I am an alert box!!");
        event.preventDefault();
        window.location = "{{route('sortbyname')}}";
    });


</script>
@endsection
