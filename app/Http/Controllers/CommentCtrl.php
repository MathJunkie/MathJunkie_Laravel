<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Kommentar;
use Illuminate\Support\Facades\Auth;
use View;
use App\Block;
use App\Script;
use Log;

class CommentCtrl extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $kommentar = new Kommentar;
        if (Auth::check()) {
            $kommentar->owner = Auth::user()->email;
            $kommentar->idScript = $request->idScript;
            $kommentar->isScript = $request->isScript;
            $kommentar->seen = false;
            $kommentar->text = $request->text;
            $kommentar->save();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    public function setSeen($id){
        $kommentar = Kommentar::where('id','=',$id)->first();
        if (empty($kommentar)){
            return "Nope";
        }
        else{
            if ($kommentar->owner == Auth::user()->email)
            {
                $kommentar->seen = true;
                $kommentar->save();
            }
        }

    }

    public function getBlockSection($id){
        return $this->makeCommentSection($id,false);
    }

    public function getScriptSection($id){
        return $this->makeCommentSection($id,true);
    }

    public function makeCommentSection($id,$isScript){
        $kommentar = Kommentar::where('idScript','=',$id)
            ->where('isScript','=',$isScript)
            ->get();
        if (empty($kommentar)){
            return 'object does not exist';
        }
        $countNew = 0;
        foreach ($kommentar as $comment){
            if (!$comment->seen){
                $countNew++;
            }
        }
        $db = null;
        if ($isScript){
            $db = Script::where('id','=',$id)->first();
        }
        else{
            $db = Block::where('id','=',$id)->first();
        }
        $script_owner = '';
        if (!empty($db)){
            $script_owner = $db->owner;
        }
        $user_email = Auth::user()->email;
        $type = 'block';
        if ($isScript){
            $type = 'script';
        }

        $is_scriptowner = $user_email == $script_owner;
        return View::make('comment.section')->with('type',$type)->with('kommentar',$kommentar)->with('countNew',$countNew)->with('id',$id)->with('user_email',$user_email)->with('is_scriptowner',$is_scriptowner);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $kommentar = Kommentar::where('id','=',$id)->first();
        if (empty($kommentar)){
            return "Nope";
        }
        else{
            if ($kommentar->owner == Auth::user()->email)
            {
                $kommentar->text = $request->text;
                $kommentar->save();
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kommentar = Kommentar::where('id','=',$id)->first();
        if (empty($kommentar))
            return 'Nope';
        elseif ($kommentar->owner == Auth::user()->email) {
            $kommentar->delete();
        }
        else{
            return response()->withErrors('Only owned comments can be deleted');
        }
    }
}
