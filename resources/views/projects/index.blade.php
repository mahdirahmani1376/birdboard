@extends('layouts.app')

@section('content')

    <div class="display: flex; align-items: center;">
        <h1 style="margin-right: auto">birdboard</h1>
        <a href="{{ route('projects.create') }}"> create project</a>
    </div>
    <ul>
        @forelse($projects as $project)
            <li class="bg-white shadow">
                <a href="{{ route('projects.show',$project) }}">
                    <p>{{ $project->title }}</p>
                </a>
            </li>
        @empty
            <li>no projects yet</li>
        @endforelse
    </ul>
@endsection
