<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Thing extends Model
{
    protected $fillable = ['headline','body','user_id'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
