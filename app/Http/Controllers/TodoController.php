<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use App\Models\Categorie;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'username' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'todos.*.description' => 'required|string',
            'todos.*.category_id' => 'required|exists:categories,id',
        ]);


        if (User::where('email', $request->email)->exists()) {
            return redirect('todo.create')->with('error', 'Email already exists');
        } elseif (User::where('username', $request->username)->exists()) {
            return redirect('todo.create')->with('error', 'Username already exists');
        } elseif (User::where('name', $request->name)->exists()) {
            return redirect('todo.create')->with('error', 'Name already exists');
        }

        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'created_by' => 1,
        ]);

        
        foreach ($request->todos as $todoData) {
            Task::create([
                'user_id' => $user->id,
                'category_id' => $todoData['category_id'],
                'description' => $todoData['description'],
                'created_by' => $user->id,
            ]);
        }
        return redirect('/')->with('success', 'User and tasks created successfully');
    }


    public function create()
    {
        $categories = Categorie::all();
        return view('welcome', compact('categories'));
    }

    public function index()
    {
        $tasks = Task::whereNull('deleted_at')->with('user')->get();
        return view('index', compact('tasks'));
    }

    public function edit($taskId)
    {   
        $task = Task::findOrFail($taskId);

        $categories = Categorie::all();
        return view('edit', compact('task', 'categories'));
    }

    public function update(Request $request, $taskId)
    {
        $task = Task::findOrFail($taskId);

        $request->validate([
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
        ]);

        $task->update([
            'description' => $request->description,
            'category_id' => $request->category_id,
        ]);

        return redirect()->route('todo.index')->with('success', 'Task updated successfully!');
    }



    public function softdelete(Task $task)
    {
        $task->deleted_at = Carbon::now();
        $task->save();

        return redirect()->route('todo.index')->with('success', 'Task deleted successfully!');
    }
}
