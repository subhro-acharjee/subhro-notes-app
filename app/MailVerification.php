<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MailVerification extends Model
{
    protected $fillable=['tokken','user_id'];
    //
    public function user(){
        return $this->belongsTo('App\User');
    }
}
