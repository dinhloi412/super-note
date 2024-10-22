@extends("layouts.app")
@section("title", "Tasks")
@section("content")
    <nav class="mb-4">
        <a  href="{{route('tasks.create')}}" class="link">
            Create a new task
        </a>
    </nav>
    <div>
        @forelse ($tasks as $task)
            <div>
                <a href="{{route('tasks.show', ['task' => $task->id])}}" @class(["font-bold","line-through" => $task->completed])>
                    {{$task->title}}
                </a>
            </div>
        @empty
            <p>No task</p>
        @endforelse

        @if($task -> count())
            <nav class="mt-4">
                {{ $tasks->links() }}
            </nav>
        @endif
    </div>
@endsection

