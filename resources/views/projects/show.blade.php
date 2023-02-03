@extends('layouts.app')

@section('content')
    <h2 class="text-lg mb-4">tasks</h2>
    @foreach($project->tasks as $task)
        <form action="{{ route('tasks.update',$task->id) }}" method="post">
            @method('PUT')

            <div class="flex">
                <input class="w-full" type="text" name="body" value="{{ $task->body }}">
                <input type="checkbox" name="completed" onchange="this.form.submit()">
            </div>
        </form>
    @endforeach

    <form action="{{ route('tasks.store', $project->id) }}" method="post">
        @csrf
        <input type="text" placeholder="enter task" name="body">

    </form>
    <h2 class="text-lg  mb-4">general notes</h2>
    <main>
        <h1>{{ $project->title }}</h1>
        <p>{{ $project->description }}</p>
    </main>
@endsection
