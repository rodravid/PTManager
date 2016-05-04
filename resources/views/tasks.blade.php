@extends('layouts.app')

@section('header')
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
@stop
@section('content')
    <div class="formInputTask container">
        <form action="/tasks" method="POST">
            <div class="col-md-5">
                <input type="text" name="title" class="form-control" placeholder="Titulo da Tarefa">
                <input type="text" name="description" class="form-control" placeholder="Descrição">
                </br>
                <button type="submit" class="btn btn-info">Enviar</button>
            </div>
        </form>
    </div>

    <div class="container">
        <h1>Tarefas</h1>
        <section class="tasksField">
            <div class="tasks container">
                <!-- Listagem de Tasks -->
                @foreach($tasks as $task)
                    <div class="taskItem row">
                        <form action="/tasks/{{ $task->id }}" method="POST">
                            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                                <ul class="nav navbar-nav">
                                    <h2>#<label name="id">{{ $task->id }}</label> | {{ $task->title }}</h2>
                                    </br>
                                    <h4 name="description">{{ $task->description }}</h4>
                                </ul>

                                <ul class="nav navbar-nav navbar-right">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="submit" class="btn btn-danger">Excluir</button>
                        </form>
                                </ul>
                            </div>

                    </div>
                @endforeach
            </div>
        </section>
    </div>
@stop