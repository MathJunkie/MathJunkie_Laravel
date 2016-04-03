<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Kommentar;
use Illuminate\Support\Facades\Auth;
use View;

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

    public function getBlockSection($id){
        $kommentar = Kommentar::where('idScript','=',$id)
            ->where('isScript','=',false)
            ->get();
        $countNew = 0;
        foreach ($kommentar as $comment){
            if (!$comment->seen){
                $countNew++;
            }
        }
        return View::make('comment.block')->with('kommentar',$kommentar)->with('countNew',$countNew)->with('id',$id);
    }

    public function getScriptSection($id){

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
            return;
        }
        else{
            $kommentar->text = $request->text;
            $kommentar->save();
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
