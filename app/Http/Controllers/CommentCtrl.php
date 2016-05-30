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

class CommentCtrl extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Auth::check()) {
            $kommentar = new Kommentar;
            $kommentar->seen = false;
            $kommentar->text = $request->text;
            $kommentar->user_id = Auth::user()->id;
            if ($request->isScript) {
                $db = Script::find($request->idScript);
            }
            else {
                $db = Block::find($request->idScript);
            }
            if (empty($db)) {
                return "nope";
            }

            $db->comments()->save($kommentar);
        }
    }

    public function getNew($id, $isScript)
    {
        if ($isScript)
            $db = Script::find($id);
        else
            $db = Block::find($id);

        if (empty($db)){
            return "0";
        }

        $kommentare = $db->comments;

        $countNew = 0;
        foreach ($kommentare as $comment) {
            if (!$comment->seen) {
                $countNew++;
            }
        }

        return $countNew;
    }

    public function setSeen($id){
        $kommentar = Kommentar::find($id);
        if (empty($kommentar)) {
            return "Nope";
        }
        else{
            if ( $kommentar->commentable->user_id == Auth::user()->id ) {
                $kommentar->seen = true;
                $kommentar->save();
            }
        }

    }

    //isScript : 0 - block
    //           1 - script
    //           2 - both

    public function hasComment($isScript) {
        if ( $isScript == 2 || $isScript == 0 ) {
            foreach (Auth::user()->blocks as $block) {
                $countNew = app('App\Http\Controllers\CommentCtrl')->getNew($block->id, false);
                if ($countNew > 0)
                    return true;
            }
        }

        if ( $isScript == 2 || $isScript == 1 ) {
            foreach (Auth::user()->scripts as $script) {
                $countNew = app('App\Http\Controllers\CommentCtrl')->getNew($script->id, true);
                if ($countNew > 0)
                    return true;
            }
        }
        return false;
    }

    public function getBlockSection($id) {
        return $this->makeCommentSection($id, false);
    }

    public function getScriptSection($id) {
        return $this->makeCommentSection($id, true);
    }

    public function makeCommentSection($id,$isScript) {
        if ($isScript)
            $db = Script::find($id);
        else
            $db = Block::find($id);

        if (empty($db)){
            return "Nope";
        }

        $kommentare = $db->comments;

        $countNew = 0;
        foreach ($kommentare as $comment) {
            if (!$comment->seen){
                $countNew++;
            }
        }

        $isScriptOwner= false;
        if (Auth::check()){
            $isScriptOwner= Auth::user()->id == $db->user_id;
        }

        $type = 'block';
        if ($isScript) {
            $type = 'script';
        }
        
        return View::make('comment.section')->with('type', $type)
                                            ->with('kommentar', $kommentare)
                                            ->with('id', $id)
                                            ->with('is_scriptowner', $isScriptOwner);
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
        $kommentar = Kommentar::find($id);
        if (empty($kommentar)) {
            return "Nope";
        }
        else {
            if ($kommentar->user_id == Auth::user()->id) {
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
        $kommentar = Kommentar::find($id);
        if ( empty($kommentar))
            return 'Nope';
        elseif ($kommentar->user_id == Auth::user()->id ) {
            $kommentar->delete();
        }
        else {
            return response()->withErrors('Only owned comments can be deleted');
        }
    }
}
