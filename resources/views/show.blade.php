@extends('layouts.app')

@section('title', $task->title)

@section('content')
<p>{{ $task->description }}</p>

@if($task->long_description)
    <p>{{ $task->long_description }}</p>
@endif

<p>{{ $task->created_at }}</p>
<p>{{ $task->updated_at }}</p>

<p>
    @if ($task->status == 'todo')
        Todo
    @elseif ($task->status == 'in_progress')
        In Progress
    @else
        Completed
    @endif
</p>

<div><a href="{{ route('tasks.edit', ['task' => $task]) }}">Edit</a></div>

<div>
    <form
        action="{{ route('tasks.destroy', ['task' => $task]) }}"
        method="post">
        @csrf
        @method('delete')
        <button type="submit">Delete</button>
    </form>
</div>
@endsection
