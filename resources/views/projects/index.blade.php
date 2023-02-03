@extends('layouts.app')

@section('content')

    <header class="flex items-center mb-3 py-4">
        <div class="flex justify-between items-end w-full ">

            <h2 class="text-gray-700 font-normal text-lg rounded py-4 text-white bg-blue-700 px-2">my projects</h2>

            <a class="rounded py-4 text-white bg-blue-700 px-2" href="{{ route('projects.create') }}"> new project</a>
        </div>
    </header>
    <main class="lg:flex lg:flex-wrap -mx-3">
            @forelse($projects as $project)
                <div class="mx-auto bg-white mr-4 p-5 shadow-2xl rounded">
                    <h3 class="font-normal text-xl py-4">
                        <a href="{{ route('projects.show',$project->id) }}">
                            {{ $project->title }}
                        </a>
                    </h3>

                    <div class="text-gray-600">{{ Str::limit($project->description) }}</div>
                </div>
            @empty
                <li>no projects yet</li>
            @endforelse
    </main>
@endsection
