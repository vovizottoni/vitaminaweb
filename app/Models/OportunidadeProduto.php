<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OportunidadeProduto extends Model
{
    use HasFactory;

    public $table = 'oportunidadesprodutos';
    
    protected $guarded = []; //Esta notação permite alteração de todos campos da tabela. Fillable para protecao..  

    

}
