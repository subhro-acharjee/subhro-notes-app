<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\notes;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(auth()->user()->verified){
            
            return view('home',['notes'=>auth()->user()->notes,'id'=>auth()->user()->id]);
        }
        else{
            auth()->logout();
            return redirect('login')->with('verify','Please Verify Your Email');
        }
        
    }
    public function saveNotes(Request $request){
        $this->validate($request,[
            'body'=>'string|required'
        ]);
        $title=$request->get('header');
        $body=$request->get('body');
        $files=$request->file('files');
        $Files=null;
        if($files){
            $Files=array();
            $i=0;
            foreach($files as $file){
                $name="file_".uniqid().".".$file->getClientOriginalExtension();
                Storage::put($name,$file->get());
                $Files[$i]=$name;
                $i++;
            }
            $filenames=implode("|",$Files);
        }
        $resp=array();
        if($title){
            $resp['header']=$title;
        }
        if($Files){
            $resp['path']=$filenames;
        }
        $resp['body']=$body;
        $resp['user_id']=auth()->user()->id;
        notes::create($resp);
        return back()->with('success','Done');
    }
    public function delete($id){
        notes::find($id)->delete();
        return back();
    }
    public function togglePublic($id){
        $val=notes::find($id);
        $val->public=!$val->public;
        $val->save();
        return back();
    }
    public function watch($id){
        $note=notes::find($id);
        $creator=$note->user;
        return view('show',['creator'=>$creator,'note'=>$note]);
    }
}
