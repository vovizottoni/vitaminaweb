<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Oportunidade extends Model
{
    use HasFactory;

    public $table = 'oportunidades';
    public $timestamps = true; 

    protected $guarded = []; //Esta notação permite alteração de todos campos da tabela. Fillable para protecao..  

    

    public function user(): BelongsTo{

        return $this->belongsTo(User::class);

    }

    public function cliente(): BelongsTo{

        return $this->belongsTo(Cliente::class); 

    }


}
