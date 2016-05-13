@extends('layouts.app')

@section('header')
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
@stop

@section('content')
    <section class="content">
        <div class="container">
            <h2>#{{ $project->id }} | {{ $project->title }}</h2>
            <form class="projectForm" action="/projects/update/{{ $project->id }}" method="POST">
                <div class="col-md-5">
                    <input type="hidden" name="_method" value="PATCH">
                    <input id="projectTitle" type="text" class="form-control" name="title" placeholder="Titulo do Projeto" required value="{{ $project->title }}">
                    <textarea id="projectDescription" type="text" class="form-control" name="description" placeholder="Descrição" required>{{ $project->description }}</textarea>
                    <button type="submit" class="btn btn-info btn-save">Salvar</button><a href="{{ URL::previous() }}" class="btn btn-default btn-return">Voltar</a>
                </div>
            </form>
    </section>
@stop