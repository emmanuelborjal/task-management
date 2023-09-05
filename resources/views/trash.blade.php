@extends('layouts.app')

@section('title', 'The list of trashed tasks')

@section('content')
<nav class="mb-4">
    <a href="{{ route('tasks.index') }}" class="link">Task List</a>
    <a href="{{ route('profile.logout') }}" class="link ml-2">Logout</a>
</nav>

@forelse($tasks as $task)
    <div class="task-item">
        <div>
            <p>{{ $task->title }}</p>
        </div>
        <div class="flex gap-2">
            <form action="{{ route('tasks.restore', ['id' => $task->id]) }}" method="get">
                <button type="submit" class="btn">Restore</button>
            </form>
            <form action="{{ route('tasks.dispose', ['id' => $task->id]) }}" method="get">
                <button type="submit" class="btn-delete">Dispose</button>
            </form>
        </div>
    </div>
@empty
    <div>There are no trashed tasks!</div>
@endforelse

@if($tasks->count())
    <nav class="mt-4">
        {{ $tasks->links() }}
    </nav>
@endif
@endsection
