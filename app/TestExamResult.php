<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TestExamResult extends Model
{
    
    public function courses()
        {
        return $this->belongsTo(App\User::class);
        }
}
