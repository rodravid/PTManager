@extends('layouts.app')

@section('header')
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
@stop

@section('content')
    <section class="content">
        <div class="container">
            <h2>#{{ $project->id }} | {{ $project->title }}</h2>
            <form class="projectForm" action="/projects/update/{{ $project->id }}" method="POST">
                <div class="col-md-4 col-md-offset-2">
                    <input type="hidden" name="_method" value="PATCH">
                    <input id="projectTitle" type="text" class="form-control" name="title" placeholder="Titulo do Projeto" required value="{{ $project->title }}">
                    <textarea id="projectDescription" type="text" class="form-control" name="description" placeholder="Descrição" required>{{ $project->description }}</textarea>
                    <button type="submit" class="btn btn-info btn-save">Salvar</button><a href="{{ URL::previous() }}" class="btn btn-default btn-return">Voltar</a>
                </div>
                <div class="col-md-4">
                    <div class="row">
                        <h4>Participantes:</h4>
                    </div>
                    <div class="row container">
                        @foreach($users as $user)
                            <input id="user{{ $user->id }}" type="checkbox" name="participants[]" value="{{ $user->id }}"><label for="user{{ $user->id }}">{{ $user->name }}</label><br>
                        @endforeach
                    </div>
                </div>
            </form>
    </section>
@stop