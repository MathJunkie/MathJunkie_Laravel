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
use Log;

class BlockCtrl extends Controller
{
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
                $block->name = $request->search;
                Auth::user()->blocks()->save($block);
                return Redirect::to('block/'.$block->id);
            }
        }
        elseif ($block->user_id == Auth::user()->id) {
            //existiert bereits, user hat aber berechtigung
            return Redirect::to('block/'.$block->id);
        }
        else{
            //existiert bereits, keine Berechtigung
            return back()->withErrors('You have no privileges for this script!');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $block = Block::find($id);
        if (empty($block)){
            return Redirect::to('block')->withErrors('Could not find the block');
        }
        else{
            return View::make('block.builder')->with('block', $block);
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
        $block = Block::find($id);
        if (empty($block))
            return back()->withErrors('Block with this id does not exists');

        if ($block->user_id == Auth::user()->id){
            $block->structure = $request->structure;
            $block->function = $request->function;
            $block->category = $request->category;
            $block->description = $request->description;
            $block->xml = $request->xml;
            $block->save();
        }
        else {
            return back()->withErrors('You have no privileges to edit anothers script');
        }
        return Redirect::to('block');
    }

    public function getList(Request $request)
    {
        return response()->json($this->getSearchJson("Block", $request->search));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->destroyObj("block", $id);
    }
}
