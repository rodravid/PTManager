@extends('layouts.app')

@section('header')
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
@stop

@section('content')
    <section class="content">
        <div class="container">
            <div class="formInputTask row">
                <form action="/tasks/save" method="POST">
                    <div class="col-md-5">
                        <input type="text" name="title" class="form-control" placeholder="Titulo da Tarefa" required>
                        <textarea type="text" name="description" class="form-control" placeholder="Descrição" required></textarea>
                        {{ Form::select('status', $status, null, ['class'=>'form-control']) }}
                        </br>
                        <button type="submit" class="btn btn-info btn-save">Salvar</button><a href="{{ URL::previous() }}" class="btn btn-default btn-return">Voltar</a>
                    </div>
                    <div class="col-md-7"></div>
                </form>
            </div>
            <h1>Tarefas | {{ $info[2] }}</h1>
            <section class="tasksField">
                <div class="tasks container">
                    <!-- Listagem de Tasks -->
                    @if($info[0]->isEmpty())
                        <div class="tasktItemFailed row">
                            <h3>Não há tarefas em aberto para este projeto</h3>
                        </div>
                    @else
                        <?php $cont = 1 ?>
                        @foreach($info[0] as $task)
                            <div class="taskItem row">
                                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                                    <ul class="nav navbar-nav">
                                        <h2>#{{ $cont }} | {{ $task->title }}</h2>
                                        <br />
                                        <h4 name="description">{{ $task->description }}</h4>
                                        <h4>STATUS: {{ $task->getPresenter()->status }}</h4>
                                    </ul>

                                    <ul class="nav navbar-nav navbar-right">
                                        <a href="/task/{{ $task->id }}/edit" class="btn btn-warning btn-form">Editar</a>
                                        <form action="/task/{{ $task->id }}/delete" method="POST">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <button type="submit" class="btn btn-danger btn-form-delete">Excluir</button>
                                        </form>
                                    </ul>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </section>
        </div>
    </section>
@stop