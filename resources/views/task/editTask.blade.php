@extends('layouts.app')

@section('header')
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
@stop

@section('content')
    <section class="content">
        <div class="container">
            <h2>#{{ $task->id }} | {{ $task->title }}</h2>
            <form class="taskForm" action="/task/{{ $task->id }}/update/" method="POST">
                <div class="col-md-5">
                    <input type="hidden" name="_method" value="PATCH">
                    <input type="text" class="form-control" name="title" placeholder="Titulo do Projeto" required value="{{ $task->title }}">
                    <textarea type="text" class="form-control" name="description" placeholder="Descrição" required>{{ $task->description }}</textarea>
                    {{ Form::select('status', $status, $task->status, ['class'=>'form-control']) }}
                    </br>
                    <button type="submit" class="btn btn-info btn-save">Salvar</button><a href="{{ URL::previous() }}" class="btn btn-default btn-return">Voltar</a>
                </div>
            </form>
    </section>
@stop