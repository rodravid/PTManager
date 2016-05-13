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
        5 => 'Enviadopriority ao Atendimento',
        6 => 'Concluída',
        7 => 'Cancelada'
    ];

    protected $priority = [
        1 => 'Baixa',
        2 => 'Média',
        3 => 'Alta',
        4 => 'Emergência'
    ];

    public function presentStatus()
    {
        return $this->status[$this->object->status];
    }

    public function presentPriority()
    {
        return $this->priority[$this->object->priority];
    }
}