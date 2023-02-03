@extends('layouts.app')

@section('content')

    <h2>tasks</h2>
    <h2>general notes</h2>
    <main>
        <h1>{{ $project->title }}</h1>
        <p>{{ $project->description }}</p>
    </main>
@endsection
