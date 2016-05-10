@extends('layouts.app')

@section('header')
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
@stop

@section('content')
    <section class="content">
        <div class="container">
            <div class="formInputProject row">
                <form class="projectForm" action="/projects/save" method="POST">
                    <div class="col-md-5">
                        <input id="projectTitle" type="text" class="form-control" name="name" placeholder="Titulo do Projeto" required >
                        <textarea id="projectDescription" type="text" class="form-control" name="description" placeholder="Descrição" required></textarea>
                        </br>
                        <button type="submit" class="btn btn-info btn-save">Salvar</button>
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
                <div class="projects container">
                    @foreach($projects as $one)
                        <div class="projectItem row">
                            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                                <div class="col-md-6">
                                    <ul class="nav navbar-nav">
                                        <h2>#<label name="id">{{ $one->id }}</label> | <a id="project{{ $one->id }}Title" href="/tasks/view/{{ $one->id }}">{{ $one->name }}</a></h2>
                                        </br>
                                        <h4 id="project{{ $one->id }}Description" name="description">{{ $one->description }}</h4>
                                    </ul>
                                </div>
                                <div class="col-md-6">
                                    <ul class="nav navbar-nav navbar-right">
                                        <div class="row">
                                            <a href="/projects/{{ $one->id }}/edit" class="btn btn-warning btn-form-update btnEdit">Editar</a>
                                            <form action="/projects/{{ $one->id }}/delete" method="POST">
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
                {!! $projects->links() !!}
            @endif
        </div>
    </section>
@stop