@extends('layouts.app')

@section('header')
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
@stop

@section('content')
    <section class="content">
        <div class="container">
            <div class="formInputProject row">
                <form class="projectForm" action="/projects/save" method="POST">
                    <div class="col-md-4 col-md-offset-2">
                        <div class="form-group">
                            <input id="projectTitle" type="text" class="form-control" name="title" placeholder="Titulo do Projeto" required>
                        </div>
                        <div class="form-group">
                            <textarea id="projectDescription" type="text" class="form-control" name="description" placeholder="Descrição" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-info btn-save">Salvar</button>
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
            </div>

            <h1>Projetos</h1>
            @if($projects->isEmpty())
                <div class="projects container">
                        <div class="projectItemFailed row">
                            <h3>Não há projetos em aberto</h3>
                        </div>
                </div>
            @else
                {{ dd($projects) }}
                <div class="projects container">
                    @foreach($projects as $project)
                        <div class="projectItem row">
                            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                                <div class="col-md-6">
                                        <h2>#<label name="id">{{ $project->id }}</label> | <a id="project{{ $project->id }}Title" href="/project/{{ $project->id }}/tasks/view/1">{{ $project->title }}</a></h2>
                                        <h4 id="project{{ $project->id }}Description" name="description">{{ $project->description }}</h4>
                                </div>
                                <div class="col-md-4">
                                    <h3>Participantes: </h3>
                                    @foreach ($project->users as $project_user)
                                        <h4>{{ $project_user->name }}</h4>
                                    @endforeach
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
                <div class="alignCenter">
                    {!! $projects->links() !!}
                </div>
            @endif
        </div>
    </section>
@stop