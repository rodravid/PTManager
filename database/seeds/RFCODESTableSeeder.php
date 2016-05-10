<?php

use App\RF_CODES;
use Illuminate\Database\Seeder;

class RFCODESTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->seed(1, 'Nova Implementação', 'Task_Tipo');
        $this->seed(2, 'Alteração', 'Task_Tipo');
        $this->seed(3, 'Emergência', 'Task_Tipo');

        $this->seed(1, 'Ativa', 'Task_Status_Open');
        $this->seed(2, 'Backlog', 'Task_Status_Open');
        $this->seed(3, 'Em Aprovação', 'Task_Status_Open');
        $this->seed(4, 'Reaberta', 'Task_Status_Open');
        $this->seed(5, 'Enviada ao Atendimento', 'Task_Status_Open');
        $this->seed(6, 'Concluída', 'Task_Status_Closed');
        $this->seed(7, 'Cancelada', 'Task_Status_Closed');

        $this->seed(1, 'Baixa', 'Task_Priority');
        $this->seed(2, 'Média', 'Task_Priority');
        $this->seed(3, 'Alta', 'Task_Priority');
        $this->seed(4, 'Emergência', 'Task_Priority');

        $this->seed(1, 'Tarefas', 'Task_Tag');
        $this->seed(2, 'Bugs', 'Task_Tag');
    }

    private function seed($ref_id, $name, $type){
        $rf_code = new RF_CODES();

        $rf_code->ref_id = $ref_id;
        $rf_code->name = $name;
        $rf_code->type = $type;
        $rf_code->save();
    }
}
