@extends('layouts.app')

@section('header')
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
@stop

@section('content')
    <section class="content">
        <div class="container">
            <h2>{{ $task->title }}</h2>
            <form class="taskForm" action="/task/{{ $task->id }}/update/" method="POST">
                <div class="col-md-4 col-md-offset-2">
                    <input type="hidden" name="_method" value="PATCH">
                    <input type="hidden" name="project_id" class="form-control" value="{{ $task->project_id }}">
                    <input type="text" class="form-control" name="title" placeholder="Titulo do Projeto" required value="{{ $task->title }}">
                    <textarea type="text" class="form-control" name="description" placeholder="Descrição" required>{{ $task->description }}</textarea>
                    <div class="row">
                        <div class="col-md-2">
                            <h4>Status</h4>
                        </div>
                        <div class="col-md-10">
                            {{ Form::select('status', [
                                        'Aberto' => $status_open,
                                        'Fechado' => $status_closed
                                                      ], $task->status, ['class'=>'form-control']) }}
                        </div>
                    </div>
                    <button type="submit" class="btn btn-info btn-save pull-left">Salvar</button><a href="/project/{{ $task->project_id }}/tasks/view/{{ $task->status }}" class="btn btn-default btn-return pull-right">Voltar</a>
                </div>
                <div class="col-md-4">
                    <div class="row">
                        <div class="col-md-3">
                            <h4>Prioridade</h4>
                        </div>
                        <div class="col-md-9">
                            {{ Form::select('priority', $task_priority, $task->priority, ['class'=>'form-control']) }}
                        </div>
                    </div>
                </div>
            </form>
    </section>
@stop