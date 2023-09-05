@extends('layouts.app')

@section('title', 'The list of tasks')

@section('content')
@forelse($tasks as $task)
    <a href="{{ route('tasks.show', ['task' => $task]) }}">
        <div>{{ $task->title }}</div>
    </a>
@empty
    <div>There are no tasks!</div>
@endforelse
@endsection
