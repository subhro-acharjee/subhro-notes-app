<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MailVerification as mv;
use App\User;

class verifyMail extends Controller
{
    //
    public function index($tokken){
        $Val=mv::where([['tokken',$tokken],['verified',false]])->orderBy('id','DESC')->first();
        if($Val){
            $Val->verified=true;
            $tmp=$Val->user;
            $tmp->Verify();
            $Val->save();
            return redirect("login");
        }
        dd($tokken);
        
    }
}
