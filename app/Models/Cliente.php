<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $table = 'clientes';
    public $timestamps = true;

    protected $guarded = []; //Esta notação permite alteração de todos campos da tabela. Fillable para protecao..  

    

}
