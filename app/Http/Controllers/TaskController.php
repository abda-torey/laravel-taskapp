<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TaskController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth');
    }




    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

   

    public function index()
    {
      $user = auth()->user()->load('tasks');
        // $tasks = Task::where('user_id', Auth::user()->id)->orderBy('created_at','desc')->get();
        return view('home',compact('user'));
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tasks = Task::where('user_id', Auth::user()->id)->orderBy('created_at','desc')->get();
        
        return view('create',compact('tasks'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'=>'required',
            'description'=>'nullable|string',
            'completed'=>'nullable',
        ]);

        $isCompleted = $request->has('completed');

        $task = Task::create([
            'title' => $request->title,
            'description' => $request->description,
            'completed' => $isCompleted,
            'user_id' => auth()->id(),
        ]);

        // $task = new Task;
        // $task->title = $request->title;
        // $task->description = $request->description;

        // if($request->has('completed'))
        // {
        //     $task->completed = true;
        // }
        // $task->user_id = Auth::user()->id;

        // $task->save();
        return redirect()->route('tasks.index');


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        return view('edit',compact('task'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        // $request->validate([
        //     'title'=>'required',
        //     'description'=>'nullable|string',
        //     'completed'=>'nullable',
        // ]);

        // $isCompleted = $request->has('completed');

        // $task = Task::create([
        //     'title' => $request->title,
        //     'description' => $request->description,
        //     'completed' => $isCompleted,
        //     'user_id' => auth()->id(),
        // ]);

        

        // $isCompleted = $request->has('completed');

        // $task = Task::create([
        //     'title' => $request->title,
        //     'description' => $request->description,
        //     'completed' => $isCompleted,
        //     'user_id' => auth()->id(),
        // ]);

        $request->validate([
            'title'=>'required',
            'description'=>'nullable|string',
            
        ]);
        $task->title = $request->title;
        $task->description = $request->description;

        if($request->has('completed')){
            $task->completed = true;
        } else {
            $task->completed = false;
        }

        $task->user_id = Auth::user()->id;

        $task->save();
        return redirect()->route('tasks.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        $task->delete();
        return back();
    }

    public function admin()
    {
        $tasks = DB::table('tasks')
            ->join('users', 'tasks.user_id', '=', 'users.id')
            ->select('tasks.*', 'users.name')
            ->get();
        
        return view('admin.index',compact('tasks'));
    }
    public function userlist()
    {
        // $users = DB::table('users')
        //     ->whereNotIn('name',['admin'])
        //     ->join('tasks','users.id','=','tasks.user_id')
        //     ->distinct()->get();

        $users = DB::table('users')
            ->whereNotIn('name',['admin'])
            ->select("users.id",DB::raw("count(tasks.user_id) as total"),"users.name as name")
            ->leftJoin('tasks','users.id','=','tasks.user_id')
            ->groupby("users.id")
            ->groupby("users.name")
            ->get();

        
    
        return view('admin.userlist',compact('users'));
    }
}
