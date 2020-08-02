<?php

namespace App\Http\Middleware;

use Closure;
use App\notes;
class ispublic
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $id=$request->route()->Parameter('id');
        
        $notes=notes::find($id);
        if($notes){
            if($notes->public){
                return $next($request);
            }
            if($notes->user_id==auth()->user()->id){
                return $next($request);
            }
        }
        abort(404);
        
    }
}
