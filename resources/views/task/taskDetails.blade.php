@extends('layouts.app')

@section('header')
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

@stop

@section('content')
    <section class="content">
        <div class="container">
            <div class="formInputTask row">
                <form action="/tasks/save" method="POST">
                    <div class="row">
                        <div class="col-md-4 col-md-offset-2">
                            <input type="hidden" name="project_id" class="form-control" value="{{ $project->id }}">

                            <div class="form-group">
                                <input type="text" name="title" class="form-control" placeholder="Titulo da Tarefa">
                            </div>
                            <div class="form-group">
                                <textarea type="text" name="description" class="form-control" placeholder="Descrição"></textarea>
                            </div>
                            <div class="row">
                                <div class="col-md-2 form-group">
                                    <h4>Status</h4>
                                </div>
                                <div class="col-md-10">
                                    {{ Form::select('status', [
                                                'Aberto' => $status_open,
                                                'Fechado' => $status_closed
                                                              ], null, ['class'=>'form-control']) }}
                                </div>
                            </div>
                            <button type="submit" class="btn btn-info btn-save">Salvar</button><a href="/projects" class="btn btn-default btn-return pull-right">Voltar</a>
                        </div>
                        <div class="col-md-4">
                            <div class="row form-group">
                                <div class="col-md-3">
                                    <h4>Prioridade</h4>
                                </div>
                                <div class="col-md-9">
                                    {{ Form::select('priority', $task_priority, 2, ['class'=>'form-control']) }}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
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
                                                <li>
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
                        </div>
                    </div>
                </form>
            </div>
            <div class="row">
                <h1>
                    <div class="col-md-4">
                        Tarefas
                    </div>
                    <div class="col-md-offset-3 col-md-5">
                        <div class="dropdown">
                            <button class="btn btn-default dropdown-toggle fill-row" type="button" id="participants" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                Projetos
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu fill-row" aria-labelledby="participants">
                                @foreach($projects as $projectId => $projectTitle)
                                    <li>
                                        <a href="#">
                                            <input id="project{{ $projectId }}" type="checkbox" name="projects[]" value="{{ $projectId }}" {{ ($project->id == $projectId) ? 'checked="checked"' : '' }}>
                                            <label for="project{{ $projectId }}">{{ $projectTitle }}</label><br>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </h1>
            </div>
            <section class="tasksField">
                <div class="tasks">
                    <div class="row">
                        <div class="col-md-8">
                            <h3 class="text-left">Abertas</h3>
                        </div>
                        <div class="col-md-4">
                            <h3 class="text-right">Fechadas</h3>
                        </div>
                    </div>
                    <div class="navigation-tabs row">
                        <div class="col-md-8">
                            <ul class="nav nav-tabs">
                                @foreach($status_open as $key => $open)
                                    <li class="{{ ($taskStatus == $key) ? 'active' : '' }}">
                                        <a href="/project/{{ $project->id }}/tasks/view/{{ $key }}">{{ $open }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="col-md-4">
                            <ul class="nav nav-tabs">
                                @foreach($status_closed as $key => $closed)
                                    <li class="{{ ($taskStatus == $key) ? 'active' : '' }} pull-right">
                                        <a href="/project/{{ $project->id }}/tasks/view/{{ $key }}">{{ $closed }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>


                    <!-- Listagem de Tasks -->
                    <div class="contentTasks">
                        @if($tasks->isEmpty())
                            <div class="tasktItemFailed row div-warning">
                                <h3>Não há tarefas com este status para este projeto</h3>
                            </div>
                        @else
                            @foreach($tasks as $key => $task)
                                <div class="taskItem row">
                                    <div class="col-md-4 overlay">
                                        <h2 class="taskInfoHeader">#{{ $task->id }} | <a href="">{{ $task->title }}</a></h2>
                                        <h3 class="project-title"><b>Projeto: </b>{{ $project->title }}</h3>
                                        <h4 class="sender"><b>Designado por: </b>{{ $task->user_name }}</h4>
                                    </div>
                                    <div class="col-md-3 details">
                                        <h4 class="taskInfoFooter"><b>STATUS:</b> {{ $task->getPresenter()->status }}</h4>
                                        <h4><b>Prioridade: </b>{{ $task->getPresenter()->priority }}</h4>
                                    </div>
                                    <div class="col-md-3">
                                        <h4 class="taskInfoDesignatedHeader">Responsável:</h4>
                                        <div class="overflow participants">
                                            @foreach ($task->users as $task_user)
                                                <h4>{{ $task_user->name }}</h4>
                                            @endforeach
                                        </div>
                                    </div>

                                    <div class="pull-right col-md-2">
                                        <a href="/task/{{ $task->id }}/edit" class="btn btn-warning btn-form">
                                            Editar
                                            <i class="fa fa-pencil-square-o margin-icon" aria-hidden="true"></i>
                                        </a>
                                        <form action="/task/{{ $task->id }}/delete" method="POST">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <button type="submit" class="btn btn-danger btn-form-delete">
                                                Excluir
                                                <i class="fa fa-trash-o margin-icon" aria-hidden="true"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                    <div class="">
                        {!! $tasks->links() !!}
                    </div>
                </div>
            </section>
        </div>
    </section>
@stop

@section('footer')

@stop