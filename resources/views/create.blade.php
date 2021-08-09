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

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('tasks.store') }}" method="post">
                        @csrf
                        <div class="form-group pr-5">
                            <label for="title">Enter Task Below:</label>
                            <input type="text" class="form-control" name="title" id="title">
                        </div>

                        <div class="form-group pr-5">
                            <label for="description" class="col-form-label text-md-right">Description</label>

                            <textarea name="description" id="description" cols="8" rows="3" class="form-control @error('password') is-invalid @enderror" autocomplete="description" ></textarea>

                        </div>
                        <div class="form-group row ml-1">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="completed" id="completed" value="{{ old('completed')}}">

                                <label class="form-check-label" for="completed">
                                    Completed?
                                </label>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Submit
                                </button>
                            </div>
                        </div>
                    </form>
                        <br><br>
                    <div class="card-header">
                        <h5 class="text-muted">Previous Tasks</h5>
                    </div>



                    <div class="container">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                            <th scope="col">#</th>
                            <th scope="col">Task Name</th>
                            <th scope="col">Task Description</th>
                            
                            </tr>
                        </thead>
                        <tbody>

                        @foreach($tasks as $task)
                            <tr>
                            <th scope="row">1</th>
                            @if ($task->completed)
                                <td><s>{{$task->title}}</s></td>
                            @else
                                <td>{{$task->title}}</td>
                            @endif
                            <td></td>
                            
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
                    
@endsection