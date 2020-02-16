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
                  
                </div>
                
            </div>
        </div>
        <div class="card-body">
            <table class="table mt-0 table-striped">
                <thead>
                    <tr>
                        <th scope="col" style="width:20%">S.N</th>
                        <th scope="col" style="width:30%">Name</th>
                        <th scope="col" style="width:30%">Audio</th>
                        <th scope="col" style="width:20%">Action</th>
                    </tr>
                </thead>
                <tbody>

                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>
                            <a><button class="btn btn-primary">Edit</button></a>
                            <a href="" class="delete_user"><button type="button"
                                    class="btn btn-danger ">Delete</button></a>
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>
    </div>
</div>


@endsection
