<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $table = 'produtos';
    public $timestamps = true;

    protected $guarded = []; //Esta notação permite alteração de todos campos da tabela. Fillable para protecao..  

    
}
