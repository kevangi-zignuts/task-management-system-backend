<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
    *   This function is used to display all tasks
    *   @method GET
    *   @route  /tasks/ (protected)
    *   @middleware (auth:sanctum)
    *   @param \Illuminate\Http\Request $request
    *   @return \Illuminate\Http\Response
    */
    public function index() {
        $tasks=Task::where('user_id', auth()->user()->id)->get();
       
        return response()->json($tasks, 200);
    }

    /**
    *   This function is used to Store task Details
    *   @method POST
    *   @route  /tasks/store (protected)
    *   @middleware (auth:sanctum)
    *   @param \Illuminate\Http\Request $request
    *   @return \Illuminate\Http\Response
    */
    public function store(Request $request){
        $task = $request->validate([
            'name' => 'required|string|max:64',
            'due_date' => 'required|date',
            'description' => 'nullable|string|max:255',
        ]);
        Log::info(Auth::id());
        $task['user_id'] = Auth::id();
        Task::create($task);
        return response()->json(['task' => $task], 201);
    }

    /**
    *   This function is used to Update task Details
    *   @method POST
    *   @route  /tasks/update/{id} (protected)
    *   @middleware (auth:sanctum)
    *   @param \Illuminate\Http\Request $request, id
    *   @return \Illuminate\Http\Response
    */
    public function update(Request $request, $id){
        $task = $request->validate([
            'name' => 'required|string|max:64',
            'due_date' => 'required|date',
            'description' => 'nullable|string|max:255',
        ]);
        $task = Task::findOrFail($id);
        $task->update($request->only(['name', 'due_date', 'description']));

        return response()->json(['task' => $task], 200);
    }

    /**
    *   This function is used to View task Details
    *   @method Get
    *   @route  /tasks/view/{id} (protected)
    *   @middleware (auth:sanctum)
    *   @param \Illuminate\Http\Request $request, id
    *   @return \Illuminate\Http\Response
    */
    public function view($id){
        $task = Task::findOrFail($id);
        return response()->json(['task' => $task], 200);
    }

    /**
    *   This function is used to Delete task Details
    *   @method Get
    *   @route  /tasks/view/{id} (protected)
    *   @middleware (auth:sanctum)
    *   @param \Illuminate\Http\Request $request, id
    *   @return \Illuminate\Http\Response
    */
    public function delete($id){
        $task = Task::findOrFail($id);
        $task->delete();
        return response()->json([
            'status'  => 'success',
            'message' => "Task's data deleted Successfully",
        ], 200);
    }
}
