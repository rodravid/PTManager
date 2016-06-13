@extends('layouts.app')

@section('header')
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
@stop

@section('content')
    <section class="content">
        <div class="container">
            <h2>#{{ $project->id }} | {{ $project->title }}</h2>
            <form class="projectForm" action="/projects/update/{{ $project->id }}" method="POST">
                <div class="col-md-12">
                    <input type="hidden" name="_method" value="PATCH">

                    <div class="col-md-6 form-group remove-padding-left">
                        <input id="projectTitle" type="text" class="form-control" name="title" placeholder="Titulo do Projeto" required value="{{ $project->title }}">
                    </div>
                    <div class="col-md-6 remove-padding-right">
                        <div class="dropdown">
                            <button class="btn btn-default dropdown-toggle fill-row" type="button" id="participants" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                Designado à
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu fill-row" aria-labelledby="participants">
                                <li>
                                    <a href="#">
                                        <input id="admin" type="checkbox" name="participants[]" value="1" checked="checked" disabled="disabled">
                                        <label for="admin">admin</label><br>
                                    </a>
                                </li>
                                @foreach($users as $user)
                                    <li for="user{{ $user->id }}">
                                        <a href="#">
                                            <input id="user{{ $user->id }}" type="checkbox" name="participants[]" value="{{ $user->id }}">
                                            <label for="user{{ $user->id }}">{{ $user->name }}</label><br>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <textarea id="projectDescription" type="text" class="form-control" name="description" placeholder="Descrição" required>{{ $project->description }}</textarea>
                    </div>
                    <button type="submit" class="btn btn-info btn-save">Salvar</button><a href="{{ URL::previous() }}" class="btn btn-default btn-return pull-right">Voltar</a>
                </div>
            </form>
        </div>
    </section>
@stop