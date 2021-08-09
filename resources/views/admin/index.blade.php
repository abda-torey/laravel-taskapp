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
                                <h5 class="text-muted">User Tasks</h5>
                            </div>
                            <div class="col-sm-6 float-right">
                               <a href="{{route('admin.userlist')}}" class="text-decoration-none"> <h5 class="text-muted">User List</h5></a>
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
                            <th scope="col" style="width:15%">Task ID</th>
                            <th scope="col" style="width:55%">Task Name</th>
                            
                            <th scope="col" style="width:30%">Task Owner</th>
                            
                            </tr>
                        </thead>
                        <tbody>

                        @foreach($tasks as $task)
                            
                            <tr>
                                <td>{{$task->id}}</td>
                            
                                <td>{{$task->title}}</td>
                                <td>{{$task->name}}</td>
                                
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
