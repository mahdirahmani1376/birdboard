@extends('layouts.app')

@section('content')

    {!! Form::open(['method'=>'post','route'=>'projects.store']) !!}

        <div class="form-group">

            {!! Form::label('title','Title:') !!}
            {!! Form::text('title',null,['class'=>'form-control']) !!}

        </div>

        <div class="form-group">

            {!! Form::label('description','description') !!}
            {!! Form::text('description',null,['class'=>'form-control']) !!}

        </div>

        <div class="form-group">
            {!! Form::submit('Create Project',['class'=>'btn btn-primary']) !!}
        </div>

    {!! Form::close() !!}

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
