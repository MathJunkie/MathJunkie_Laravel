<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Block;
use App\Kommentar;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use View;

class BlockCtrl extends Controller
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
        $block = Block::where('name','=',$request->search)->first();
        if (empty($block)) {
            //richtig
            if (Auth::check())
            {
                $block = new Block();
                $block->owner = Auth::user()->email;
                $block->name = $request->name;
                $block->save();
                return Redirect::to('block/'.$block->id);
            }
        }
        elseif ($block->owner == Auth::user()->email) {
            //existiert bereits, user hat aber berechtigung
            Redirect::to('block/'.$block->id);
        }
        else{
            //existiert bereits, keine Berechtigung
            return back()->withErrors('Der Block existiert bereits und du hast keine Berechtigung zum Bearbeiten');
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
        $block = Block::where('id','=',$id)->first();
        if (empty($block)){
            return Redirect::to('block')->withErrors('Could not find the block');
        }
        else{
            return View::make('block.builder')->with('block',$block);
        }
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
        $block = Block::where('id','=',$id)->first();
        if ($block->owner == Auth::user()->email){
            $block->structure = $request->structure;
            $block->function = $request->function;
            $block->category = $request->category;
            $block->description = $request->description;
            $block->xml = $request->xml;
            $block->save();
        }
        else
            return back()->withErrors('You have no privileges to edit anothers script');
        return Redirect::to('block');
    }

    public function getList(Request $request)
    {
        $block = Block::where('name','like', $request->search.'%')
                 ->orWhere('description','like', $request->search.'%')->get();

        $resp = array();
        foreach ($block as $item){
            $entry = [
                "description" => $item->description,
                "name" => $item->name,
                "id" => $item->id,
            ];
            array_push($resp,$entry);
        }
        return response()->json($resp);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $block = Block::where('id','=',$id)->first();
        if ($block->owner == Auth::user()->email){
            $kommentar = Kommentar::where('idScript','=',$block->id)
                ->where('isScript','=',false)
                ->get();
            foreach ($kommentar as $comment){
                $comment->delete();
            }
            $block->delete();
        }
        return Redirect::to('block');
    }
}
