@extends('layouts.app')

@section('content')
<h1>BirdBoard</h1>

    <ul>
        @forelse($projects as $project)
            <li>
                <a href="{{ route('projects.show',$project) }}">
                    <p>{{ $project->title }}</p>
                </a>
            </li>
        @empty
            <li>no projects yet</li>
        @endforelse
    </ul>
@endsection
