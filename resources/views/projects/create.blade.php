@extends('layouts.app')

@section('content')

    <div class="w-full max-w-xs">
        <form action="{{ route('projects.store') }}" method="post">
            @csrf
            <div class="mb-4">
                <label for="title">tile</label>
                <input class="form-input" type="text" name="title">
            </div>
            <div class="mb-4">
                <label for="description">description</label>
                <input class="form-input" type="text" name="description">
            </div>
            <div>
                <input type="submit">
            </div>
        </form>
    </div>

    @if(count($errors) > 0)

        <div class="alert alert-danger">
            <ul>

                @foreach($errors->all() as $error)

                    <li>
                        {{ $error }}
                    </li>

                @endforeach

            </ul>
        </div>
    @endif

@endsection
