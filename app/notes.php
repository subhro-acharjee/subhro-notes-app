<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class notes extends Model
{
    //
    protected $fillable=['header','body','path','user_id'];
    public function user(){
        return $this->belongsTo('App\User');
    }
}
