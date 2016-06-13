<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->seed('admin', 'admin@admin.com.br', 'w11admin');
        $this->seed('Rodrigo David de Oliveira', 'roliveira@webeleven.com.br', 'w11admin');
        $this->seed('Felipe Alcantara', 'falcantara@webeleven.com.br', 'w11admin');
        $this->seed('Thiago Del Ré Cavallini', 'tcavallini@webeleven.com.br', 'w11admin');
        $this->seed('Wellington Silva', 'wsilva@webeleven.com.br', 'w11admin');
    }

    public function seed($name, $email, $password)
    {
        $user = new User();
        
        $user->name = $name;
        $user->email = $email;
        $user->password = bcrypt($password);

        $user->save();
    }
}
