<?php

use Illuminate\Database\Seeder;
use \App\Pessoa;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $this->call('TabelaUsuarioSeeder');
    }
}

class TabelaUsuarioSeeder extends Seeder {

    public function run()
    {
        $usuarios = Pessoa::get();

        if($usuarios->count() == 0) {
            Pessoa::create(array(
                'email' => 'pds@unisc.br',
                'password' => Hash::make('1234'),
                'nome'  => 'Trabalho de PDS'
            ));
        }
    }

}