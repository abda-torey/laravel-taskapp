@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <a href="{{ route('tasks.create') }}" class="btn btn-primary">Create Task</a><br><br>

                <div class="container">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                            <th scope="col" style="width:5%">#</th>
                            <th scope="col" style="width:55%">Task Name</th>
                            
                            <th scope="col" style="width:40%">Action</th>
                            
                            </tr>
                        </thead>
                        <tbody>

                        @foreach($user->tasks as $task)
                            <tr>
                                <td>1</td>
                            @if ($task->completed)
                                <td><s>{{$task->title}}</s></td>
                            @else
                                <td>{{$task->title}}</td>
                            @endif
                                
                            
                            <td class="mr-5">

                                <div class="container">
                                    <div class="row">
                                        <div class="col-sm 6">
                                            <a href="{{route('tasks.edit',$task->id)}}" class="btn btn-primary"><i class="glyphicon glyphicon-pencil"></i> Edit</i></a>
                                
                                        </div>
                                        <div class="col-sm 6">
                                            <form action="{{ route('tasks.destroy', $task->id) }}" method="post"> {{-- Delete --}}
                                            @csrf
                                            @method('delete')
                                                <button type="submit" class="btn btn-danger mr-5">Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                
                                </td>
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
