@extends('layouts.app')

@section('header')
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
@stop

@section('content')
    <section class="content">
        <div class="container">
            <div class="formInputProject row">
                <form class="projectForm" action="/projects/save" method="POST">
                    <div class="col-md-8 col-md-offset-2 form-group">
                        <div class="col-md-6 remove-padding-left">
                            <input id="projectTitle" type="text" class="form-control" name="title" placeholder="Titulo do Projeto" required>
                        </div>
                        <div class="col-md-6 remove-padding-right">
                            <div class="dropdown">
                                <button class="btn btn-default dropdown-toggle fill-row" type="button" id="participants" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                    Participantes
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu fill-row" aria-labelledby="participants">
                                    <li>
                                        <a href="#">
                                            <input id="admin" type="checkbox" name="participants[]" value="1" checked="checked" disabled="disabled">
                                            <label for="admin">admin</label><br>
                                        </a>
                                    </li>
                                    <li role="separator" class="divider"></li>
                                    <li class="dropdown-header">Desenvolvedores</li>
                                    @foreach($users as $user)
                                        <li for="user{{ $user->id }}">
                                            <a href="#">
                                                <input id="user{{ $user->id }}" type="checkbox" name="participants[]" value="{{ $user->id }}">
                                                <label for="user{{ $user->id }}">{{ $user->name }}</label><br>
                                            </a>
                                        </li>
                                    @endforeach
                                    <li role="separator" class="divider"></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8 col-md-offset-2">
                        <div class="form-group">
                            <textarea id="projectDescription" type="text" class="form-control" name="description"
                                      placeholder="Descrição" required></textarea>
                        </div>
                    <button type="submit" class="btn btn-info btn-save fill-row">Salvar</button>
                    </div>
                </form>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <h1>Projetos</h1>
                </div>
                <div class="col-md-9">
                    <div class="pull-right">
                        {!! $projects->links() !!}
                    </div>
                </div>
            </div>
            @if($projects->isEmpty())
                <div class="projects container">
                        <div class="projectItemFailed row">
                            <h3>Não há projetos em aberto</h3>
                        </div>
                </div>
            @else
                <div class="projects container">
                    @foreach($projects as $project)
                        <div class="projectItem row overflow">
                            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                                <div class="col-md-6">
                                        <h2>#<label name="id">{{ $project->id }}</label> | <a id="project{{ $project->id }}Title" href="/project/{{ $project->id }}/tasks/view/1">{{ $project->title }}</a></h2>
                                        <h4 id="project{{ $project->id }}Description" name="description">{{ $project->description }}</h4>
                                </div>
                                <div class="col-md-4">
                                    <h3>Participantes: </h3>
                                    <div class="overflow participants">
                                        @foreach ($project->users as $project_user)
                                            <h4>{{ $project_user->name }}</h4>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <ul class="nav navbar-nav navbar-right">
                                        <div class="row">
                                            <a href="/projects/{{ $project->id }}/edit" class="btn btn-warning btn-form-update">Editar</a>
                                            <form action="/projects/{{ $project->id }}/delete" method="POST">
                                                <input type="hidden" name="_method" value="DELETE">
                                                <button type="submit" class="btn btn-danger btn-form-delete">Excluir</button>
                                            </form>
                                        </div>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </section>
@stop