<?php

use App\Http\Controllers\ProfileController;
use App\Http\Requests\TaskRequest;
use App\Models\Task;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware('auth')->group(function () {
    Route::get('/profile/logout', [ProfileController::class, 'logout'])->name('profile.logout');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/', function () {
        return redirect()->route('tasks.index');
    });

    Route::get('/tasks', function () {
        return view('index', [
            'tasks' => Task::latest()->paginate(10),
        ]);
    })->name('tasks.index');

    Route::get('/tasks/trash', function () {
        return view('trash', [
            'tasks' => Task::onlyTrashed()->paginate(10),
        ]);
    })->name('tasks.trash');

    Route::view('/tasks/create', 'create')->name('tasks.create');

    Route::get('/tasks/{task}/edit', function (Task $task) {
        return view('edit', ['task' => $task]);
    })->name('tasks.edit');

    Route::get('/tasks/{task}', function (Task $task) {
        return view('show', ['task' => $task]);
    })->name('tasks.show');

    Route::post('/tasks', function (TaskRequest $request) {
        $task = Task::create($request->validated());
        return redirect()->route('tasks.show', ['task' => $task])
            ->with('success', 'Task created successfully!');
    })->name('tasks.store');

    Route::put('/tasks/{task}', function (Task $task, TaskRequest $request) {
        $task->update($request->validated());
        return redirect()->route('tasks.show', ['task' => $task])
            ->with('success', 'Task updated successfully!');
    })->name('tasks.update');

    Route::get('/tasks/{id}/restore', function ($id) {
        $task = Task::onlyTrashed()->findOrFail($id);
        $task->restore();
        return redirect()->route('tasks.show', ['task' => $task])
            ->with('success', 'Task restored successfully!');
    })->name('tasks.restore');
    
    Route::get('/tasks/{id}/dispose', function ($id) {
        $task = Task::onlyTrashed()->findOrFail($id);
        $task->forceDelete();
        return redirect()->route('tasks.trash')
            ->with('success', 'Task disposed successfully!');
    })->name('tasks.dispose');

    Route::delete('/tasks/{task}', function (Task $task) {
        $task->delete();
        return redirect()->route('tasks.index')
            ->with('success', 'Task deleted successfully!');
    })->name('tasks.destroy');
});

require __DIR__ . '/auth.php';
