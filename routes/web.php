<?php

use App\Http\Requests\TaskRequest;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return redirect() -> route("tasks.index");
});
Route::get('/tasks', action: function () {
    return view("index", [
        "tasks" => Task::latest()->paginate(5)
    ]);
})->name("tasks.index");

Route::view("/tasks/create", "create") -> name("tasks.create");

Route::get("/tasks/{task}", function (Task $task) {
    return view("show", [
        "task" => $task
    ]);
})-> name("tasks.show");

Route::get("/tasks/{task}/edit", function ($id) {
    return view("edit", [
        "task" => Task::findOrFail($id)
    ]);
})-> name("tasks.edit");


Route::post("/tasks", function (TaskRequest $request) {
    $task = Task::create($request->validated());

    return redirect() -> route("tasks.show", ["task" => $task->id])->with("success", "Task created successfully");

})->name("tasks.store");

Route::put("/tasks/{task}", function (Task $task, TaskRequest $request) {
    $task->update($request->validated());
    return redirect() -> route("tasks.show", ["task" => $task->id])->with("success", "Task updated successfully");
})->name("tasks.update");

Route::delete("/tasks/{task}", function (Task $task) {
    $task->delete();
    return redirect() -> route("tasks.index")->with("success", "Task deleted successfully");
})->name("tasks.destroy");

Route::put("/tasks/{task}/complete", function (Task $task) {
    $task->toggleComplete();
    return redirect()->back()->with("success", "Task completed");
})->name("tasks.toggle-complete");


