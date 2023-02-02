@extends('layouts.app')

@section('content')

    <div class="flex items-center mb-3">
        <h1 class="mr-auto">birdboard</h1>
        <a href="{{ route('projects.create') }}"> new project</a>
    </div>
    <div class="flex">
            @forelse($projects as $project)
                <div class="mx-auto bg-white mr-4 p-5 shadow-2xl rounded">
                    <h3>{{ $project->title }}</h3>

                    <div>{{ Str::limit($project->description) }}</div>
                </div>
            @empty
                <li>no projects yet</li>
            @endforelse
    </div>
@endsection
