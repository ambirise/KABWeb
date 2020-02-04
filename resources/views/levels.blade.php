@extends('home')
@section('content')
<div class="container">

    <div class="container">
        <a href="{{ url('/levels') }}"><h6>Levels</h6></a>
        <div class="card mt-2">
            <div class="card-header text-center">
                <div class="row">
                    <div class="col-md-8">
                        <form action="{{ route('getlevelsSearch')}}" method="POST" role="search">
                            {{ csrf_field() }}
                            <div class="input-group" class="columnpatient1">
                                <input type="text" class="form-control" name="q" placeholder="Search">
                                <span class="input-group-btn">
                                    <button type="submit" class="btn btn-secondary">
                                        Search
                                    </button>
                                </span>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-4">
                        <!-- // for other additional pages -->
                        <!-- <button class="btn btn-outline-primary" id="addfacultybutton" style="float:right">ADD</button> -->
                    </div>
                </div>
            </div>
            <div class="card-body">


                <table class="table mt-0 table-striped">
                    <thead>
                        <tr>
                            <th scope="col">S.N</th>
                            <th scope="col">Level Title</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($get_level_data as $key=>$level_data)

                        <tr onclick="window.location = '{{route('getfacultiesIndex',$level_data->level_id)}}'"
                            style="cursor:pointer;">
                            <td>{{$key+1}}</td>
                            <td>{{$level_data->level_title}}</td>

                        </tr>

                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    @endsection
