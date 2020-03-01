@extends('home')
@section('content')
<div class="container">
    <div class="container"><br>
          <a href="{{ url('/levels') }}">
            <span>Levels</span>
        </a>

        @if($message = Session::get('searchnotfound'))
        <div class="mt-2">
            <div class="alert alert-danger" role="alert">
                <p>{{$message}}<p>
            </div>
        </div>
        @endif

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
