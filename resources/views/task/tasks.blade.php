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
                            <input type="hidden" name="project_id" class="form-control" value="{{ $return['ProjectReturned']->id }}">
                            <input type="text" name="title" class="form-control" placeholder="Titulo da Tarefa">
                            <textarea type="text" name="description" class="form-control" placeholder="Descrição"></textarea>
                            <div class="row">
                                <div class="col-md-2">
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
                            <div class="row">
                                <div class="col-md-3">
                                    <h4>Prioridade</h4>
                                </div>
                                <div class="col-md-9">
                                    {{ Form::select('priority', $task_priority, 2, ['class'=>'form-control']) }}
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <h1>Tarefas | {{ $return['ProjectReturned']->title }}</h1>
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
                                    <li class="{{ ($return['Status'] == $key) ? 'active' : '' }}">
                                        <a href="/project/{{ $return['ProjectReturned']->id }}/tasks/view/{{ $key }}">{{ $open }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="col-md-4">
                            <ul class="nav nav-tabs">
                                @foreach($status_closed as $key => $closed)
                                    <li class="{{ ($return['Status'] == $key) ? 'active' : '' }} pull-right">
                                        <a href="/project/{{ $return['ProjectReturned']->id }}/tasks/view/{{ $key }}">{{ $closed }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>


                    <!-- Listagem de Tasks -->
                    <div class="contentTasks">
                        @if($return['TasksReturned']->isEmpty())
                            <div class="tasktItemFailed row div-warning">
                                <h3>Não há tarefas com este status para este projeto</h3>
                            </div>
                        @else
                            @foreach($return['TasksReturned'] as $key => $task)
                                <div class="taskItem row">
                                    <div class="col-md-5 overlay">
                                        <h2 class="taskInfoHeader">#{{ $key+1 }} | {{ $task->title }}</h2>
                                        <h3 class="sender">Remetente: {{ $task->user_name }}</h3>
                                        <h4  class="description" name="description">{{ $task->description }}</h4>
                                        <h4 class="taskInfoFooter">STATUS: {{ $task->getPresenter()->status }}  |  Prioridade: {{ $task->getPresenter()->priority }}</h4>
                                    </div>

                                    <div class="col-md-5">
                                        <h4 class="taskInfoDesignatedHeader">Designado para:</h4>
                                    </div>

                                    <div class="pull-right col-md-2">
                                        <a href="/task/{{ $task->id }}/edit" class="btn btn-warning btn-form">Visualizar</a>
                                        <form action="/task/{{ $task->id }}/delete" method="POST">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <button type="submit" class="btn btn-danger btn-form-delete">Excluir</button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                    <div class="">
                        {!! $return['TasksReturned']->links() !!}
                    </div>
                </div>
            </section>
        </div>
    </section>
@stop