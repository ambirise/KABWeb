@extends('home')
@section('content')
<div class="container">
    <div class="card mt-4">
        <div class="card-header text-center">
            <h5>Welcome To The Home Page</h5>
        </div>
    </div>
    <div class="card-body">

    </div>
</div>

<div class="container">
    <div class="card mt-2">
        <div class="card-header text-center">
            <div class="row">
                <div class="col-md-8">
                <form action="{{ route('getallSearch')}}" method="POST"
                        role="search">
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
            </div>
        </div>
        <div class="card-body">
            <table class="table mt-0 table-striped">
                <thead>
                    <tr>
                        <th scope="col" style="width:10%">S.N</th>
                        <th scope="col" style="width:40%">Search Results</th>
                        <th scope="col" style="width:50%"></th>
                     
                    </tr>
                </thead>
                <tbody>
         
                @if(isset($data))
                @foreach($data as $key=>$get_search_data)
                    @if(isset($get_search_data->subject_title))
                    <tr onclick="window.location = '{{route('getchaptersIndex',$get_search_data->subject_id)}}'"
                        style="cursor:pointer;">
                    @else
                    <tr onclick="window.location = '{{route('getsubjectsIndex',$get_search_data->faculty_id)}}'"
                        style="cursor:pointer;">
                    @endif
                    
                        <td>{{$key+1}}</td>
                        @if(@isset($get_search_data->subject_title))
                        <td>{{$get_search_data->subject_title}}</td>
                        <td>{{$get_search_data->level_title}}/{{$get_search_data->faculty_title}}</td>
                        @else
                        <td>{{$get_search_data->faculty_title}}</td>
                        <td>{{$get_search_data->level_title}}</td>
                         @endif
                    </tr>
                @endforeach
                @endif
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
