@extends('home')
@section('content')

<br>
<div class="container">
    <h5 class="text-center">Please Select an Option To Sort</h5><br>
    <div class="row text-center">
        <div class="col-md-3 ">
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
        <div class="col-md-3">
            <div>Age</div>
            <div>
                <form action="{{route('sortbyage')}}" method="POST" enctype="mutipart/form-data">
                @csrf
                    <div class="form-row">
                        <div class="col">
                            <input type="text" name="from" class="form-control" placeholder="From">
                        </div>
                        <div class="col">
                            <input type="text" name="to" class="form-control" placeholder="To">
                        </div>
                    </div>

                    <button type="submit"  class="btn btn-primary mb-2 mt-1 pt-0">Sort by Age</button>
                </form>
            </div>
        </div>
        <div class="col-md-3">
            <div>Gender</div>
            <div>
                @if(isset($sortbyfemale))
                <label class="btn btn-light">
                    <input type="radio" name="optradio5" autocomplete="off" checked="checked" id="sortbyfemale"
                        value="0">
                    Female
                </label>
                @else
                <label class="btn btn-light">
                    <input type="radio" name="optradio5" autocomplete="off" id="sortbyfemale" value="0">
                    Female
                </label>
                @endif

                @if(isset($sortbymale))
                <label class="btn btn-light">
                    <input type="radio" name="optradio6" autocomplete="off" checked="checked" id="sortbymale" value="0">
                    Male
                </label>
                @else
                <label class="btn btn-light">
                    <input type="radio" name="optradio6" autocomplete="off" id="sortbymale" value="0">
                    Male
                </label>
                @endif
            </div>
        </div>
        <div class="col-md-3">
            <div>Type of Blindness</div>
            <div>
                @if(isset($sortbyfullblind))
                <label class="btn btn-light">
                    <input type="radio" name="optradio7" autocomplete="off" checked="checked" id="sortbyfullblind"
                        value="0">
                    Full Blind
                </label>
                @else
                <label class="btn btn-light">
                    <input type="radio" name="optradio7" autocomplete="off" id="sortbyfullblind" value="0">
                    Full Blind
                </label>
                @endif

                @if(isset($sortbyhalfblind))
                <label class="btn btn-light">
                    <input type="radio" name="optradio8" autocomplete="off" checked="checked" id="sortbyhalfblind"
                        value="0">
                    Half Blind
                </label>
                @else
                <label class="btn btn-light">
                    <input type="radio" name="optradio8" autocomplete="off" id="sortbyhalfblind" value="0">
                    Half Blind
                </label>
                @endif
            </div>
        </div>

    </div>
   
    <a href="{{ url('/export') }}"><button type="button" class="btn btn-primary pt-0" style="float:right;">Download as
            Excel</button></a>
    <br><br>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">S.N</th>
                <th scope="col">Name</th>
                <th scope="col">Age</th>
                <th scope="col">Phone</th>
                <th scope="col">Email</th>
                <th scope="col">Gender</th>
                <th scope="col">Address</th>
                <th scope="col">Blindness Type</th>
            </tr>
        </thead>
        <tbody>
            @foreach($statistics as $key=>$data)
            <tr>
                <th scope="row">{{$key+1}}</th>
                <td>{{$data->name}}</td>
                <td>{{$data->age}}</td>
                <td>{{$data->phone}}</td>
                <td>{{$data->email}}</td>
                <td>{{$data->gender}}</td>
                <td>{{$data->address}}</td>
                <td>{{$data->type}}</td>
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


    $("[name=optradio5]").on("click", function (event) {
        //  alert("Hello! I am an alert box!!");
        event.preventDefault();
        window.location = "{{route('sortbyfemale')}}";
    });

    $("[name=optradio6]").on("click", function (event) {
        //  alert("Hello! I am an alert box!!");
        event.preventDefault();
        window.location = "{{route('sortbymale')}}";
    });

    $("[name=optradio7]").on("click", function (event) {
        //  alert("Hello! I am an alert box!!");
        event.preventDefault();
        window.location = "{{route('sortbyfullblind')}}";
    });

    $("[name=optradio8]").on("click", function (event) {
        //  alert("Hello! I am an alert box!!");
        event.preventDefault();
        window.location = "{{route('sortbyhalfblind')}}";
    });

</script>
@endsection
