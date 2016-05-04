@extends('layouts.app')

@section('header')
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
@stop
@section('content')
    <div class="formInputTask row container">
        <form action="/" method="POST">
            <div class="col-md-5">
                <input type="text" name="title" class="form-control" placeholder="Titulo da Tarefa">
                <input type="text" name="description" class="form-control" placeholder="Descrição">
                </br>
                <button type="submit" class="btn btn-info">Enviar</button>
            </div>
        </form>
    </div>

    <div class="contentField">
        <h1>Tarefas</h1>
        <section class="tasksField">
            <div class="tasks container">
                <!-- Listagem de Tasks -->
                @foreach($tasks as $task)
                    <div class="taskItem row">
                        <h2>{{ $task->title }}</h2>
                        </br>
                        <h4>{{ $task->description }}</h4>
                    </div>
                @endforeach
            </div>
        </section>
    </div>
@stop