<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

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
        $tasks=Task::all();
       
        return response()->json($tasks, 200);
    }
}
