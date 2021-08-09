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

                    <form action="{{ route('tasks.update',$task->id) }}" method="post">
                    @csrf
                    @method('PUT')
                        <div class="form-group pr-5">
                            <label for="title">Enter Task Below:</label>
                            <input type="text" class="form-control" name="title" id="title" value="{{$task->title}}">
                        </div>

                        <div class="form-group pr-5">
                            <label for="description" class="col-form-label text-md-right">Description</label>

                            <textarea  name="description" id="description" cols="8" rows="3" class="form-control @error('password') is-invalid @enderror" autocomplete="description" >{{$task->description}}</textarea>

                        </div>
                        <div class="form-group row ml-1">
                            <div class="form-check">

                                @if($task->completed)
                                    <input class="form-check-input" type="checkbox" name="completed" id="completed" value="{{ $task->completed }}" checked>


                                @else
                                    <input class="form-check-input" type="checkbox" name="completed" id="completed" value="{{ $task->completed}}">

                                @endif
                                
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
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection