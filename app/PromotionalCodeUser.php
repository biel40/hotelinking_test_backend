<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class PromotionalCodeUser extends Pivot
{
        
    public $timestamps = false;

    protected $table = 'promotional_code_user';

    protected $fillable = ['user_id', 'promotional_code_id', 'code', 'active'];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function promotionalCode()
    {
        return $this->belongsTo(PromotionalCode::class);
    }
    
}
