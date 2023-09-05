@extends('layouts.app')

@section('title', $task->title)

@section('content')
<div class="mb-4">
    <a href="{{ route('tasks.index') }}" class="link">← Go back to the task list!</a>
</div>

<p class="mb-4 text-slate-700">{{ $task->description }}</p>

@if($task->long_description)
    <p class="mb-4 text-slate-700">{{ $task->long_description }}</p>
@endif

<p class="mb-4 text-sm text-slate-500">Created {{ $task->created_at->diffForHumans() }} • Updated
    {{ $task->updated_at->diffForHumans() }}</p>

<p class="mb-4">
    @if($task->status == 'todo')
        <span class="font-medium text-red-500">Todo</span>
    @elseif($task->status == 'in_progress')
        <span class="font-medium text-blue-500">In Progress</span>
    @else
        <span class="font-medium text-green-500">Completed</span>
    @endif
</p>

<div class="flex gap-2">
    <a href="{{ route('tasks.edit', ['task' => $task]) }}"
        class="btn-edit">
        Edit
    </a>

    <form
        action="{{ route('tasks.destroy', ['task' => $task]) }}"
        method="post">
        @csrf
        @method('delete')
        <button type="submit" class="btn-delete">Delete</button>
    </form>
</div>
@endsection
