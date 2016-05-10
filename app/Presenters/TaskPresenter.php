<?php

namespace App\Presenters;

use Robbo\Presenter\Presenter;

class TaskPresenter extends Presenter
{

    protected  $status = [
        1 => 'Ativo',
        2 => 'Em Backlog',
        3 => 'Em Aprovação',
        4 => 'Reaberta',
        5 => 'Enviado ao Atendimento'
    ];

    public function presentStatus()
    {
        return $this->status[$this->object->status];
    }
}