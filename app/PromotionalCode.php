<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PromotionalCode extends Model
{
    
    public $timestamps = false;

    protected $table = 'promotional_code';
    
    protected $fillable = ['code_title', 'description', 'price'];

    public function users()
    {
        return $this->hasMany(PromotionalCodeUser::class);
    }

}
