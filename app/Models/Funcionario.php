<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Funcionario extends Model
{
    use HasFactory;

    protected $fillabe =['id',
                        'nome',
                        'endereco',
                        'email',
                        'telefone'];

    protected $table = 'Funcionario';
    /* Possvivel mudar a chave primaria
        protected $primaryKey = 'nome_da_apk'

        se nao quiser que seja auto_increment
        public $incremente = false;
    */


}
