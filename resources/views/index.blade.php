@extends('layouts.app')

@section('title', 'The list of tasks')

@section('content')
<nav class="mb-4">
    <a href="{{ route('tasks.create') }}" class="link">Add Task</a>
    <a href="{{ route('tasks.latest') }}" class="link ml-2">Latest Task</a>
    <a href="{{ route('tasks.oldest') }}" class="link ml-2">Oldest Task</a>
    <a href="{{ route('tasks.trash') }}" class="link ml-2">Trashed Tasks</a>
    <a href="{{ route('profile.logout') }}" class="link ml-2">Logout</a>
</nav>

<div class="mb-8">
    <form action="{{ route('tasks.index') }}" method="GET">
        <input type="text" name="search" placeholder="Search tasks">
    </form>
</div>

@forelse($tasks as $task)
    <div class="task-item">
        <a href="{{ route('tasks.show', ['task' => $task]) }}"
            @class(['line-through'=> $task->status == 'completed'])>
            {{ $task->title }}
        </a>
    </div>
@empty
    <div>There are no tasks!</div>
@endforelse

@if($tasks->count())
    <nav class="mt-4">
        {{ $tasks->links() }}
    </nav>
@endif
@endsection
