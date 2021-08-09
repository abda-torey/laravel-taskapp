@extends('admin.app')

@section('admincontent')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="container">
                        <div clas="row">
                            <div class="col-sm-6 float-left">
                                <a href="{{route('admin.dashboard')}}" class="text-decoration-none"><h5 class="text-muted">User Tasks</h5></a>
                            </div>
                            <div class="col-sm-6 float-right">
                                <h5 class="text-muted">User List</h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                   

                <div class="container">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                            
                            <th scope="col" style="width:20%;">User ID</th>
                            <th scope="col" style="width:50%">User Name</th>
                            <th scope="col" style="width:30%">Total Number of Tasks</th>
                            
                            
                            
                            </tr>
                        </thead>
                        <tbody>

                        @foreach($users as $user)
                            
                            <tr>
                                
                                <td>{{$user->id}}</td>
                                <td>{{$user->name}}</td>
                                <td>{{$user->total}}</td>
                                
                            </tr>
                            
                            
        
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
