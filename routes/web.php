<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;

Route::get('/', [TodoController::class, 'create'])->name('todo.create');
Route::post('/', [TodoController::class, 'store'])->name('todo.store');

Route::get('/todo', [TodoController::class, 'index'])->name('todo.index');

Route::get('/todo/edit/{task}', [ToDoController::class, 'edit'])->name('todo.edit');
Route::put('/todo/update/{task}', [ToDoController::class, 'update'])->name('todo.update');
Route::put('/todo/{task}', [ToDoController::class, 'softdelete'])->name('todo.softdelete');
