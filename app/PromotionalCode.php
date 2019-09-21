<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PromotionalCode extends Model
{
    // Ponemos en fillable aquellos campos de la BB.DD que queramos editar
    protected $fillable = ['code_title', 'description', 'price'];
}
