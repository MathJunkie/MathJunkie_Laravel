<?php

namespace App\Http\Controllers;

use App\category_color;
use App\Script;
use App\Block;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use SimpleXMLElement;
use Symfony\Component\HttpFoundation\Response;
use View;
use Log;

class ScriptCtrl extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $script = Script::where('name','=',$request->search)->first();
        if (empty($script)) {
            //richtig
            if (Auth::check())
            {
                $script = new Script();
                $script->name = $request->search;
                Auth::user()->scripts()->save($script);
                return Redirect::to('script/'.$script->id);
            }
        }
        elseif ($script->user_id == Auth::user()->id) {
            //existiert bereits, user hat aber berechtigung
            return Redirect::to('script/'.$script->id);
        }
        else{
            //existiert bereits, keine Berechtigung
            return back()->withErrors('You have no privileges for this script!');
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
        $script = Script::find($id);
        if (empty($script)){
            return Redirect::to('script')->withErrors('Could not find the script');
        }
        else {
            return View::make('script.view')->with('script',$script)->with('isView',true);
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
        $script = Script::find($id);
        if (empty($script)){
            return Redirect::to('script')->withErrors('Could not find the script');
        }
        else{
            $xml = '<xml id="toolbox" style="display: none">';
            $block = Block::all();
            $xml_array = [];
            $structure = '';
            $function = '';
            foreach ($block as $item){
                $structure .= $item->structure;
                $function .= $item->function;
                $temp = [
                    $item->category => $item->name,
                ];
                $xml_array = array_merge_recursive($xml_array,$temp);
            }
           $keys = array_keys($xml_array);
           foreach ($keys as $key){
               $color = category_color::where('name','=',$key)->first();
               if (empty($color)){
                   $xml .= '<category name="'.$key.'">';
               }
               else{
                   $xml .= '<category colour="'.$color->color.'" name="'.$key.'">';
               }
                $b_item = $xml_array[$key];
                if (!is_array($b_item)){
                    $xml .= '<block type="'.$b_item.'"></block>';
                }
                else{
                    foreach ($b_item as $item){
                        $xml .= '<block type="'.$item.'"></block>';
                    }
                }
                $xml .= '</category>';
            }
            $xml .= '</xml>';
            $content = [];
            $content['xml'] = $xml;
            $content['structure'] = $structure;
            $content['function'] = $function;

            return View::make('script.builder')->with('content',$content)->with('script',$script);
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
        $script = Script::find($id);
        if ($script->user_id == Auth::user()->id){
            $script->structure = $request->xml;
            $script->function = $request->function;
            $script->description = $request->description;
            $script->save();
        }
        else
            return back()->withErrors('You have no privileges to edit anothers script');
        return Redirect::to('script');
    }

    public function getList(Request $request)
    {
        $script = Script::where('name','like', '%'.$request->search.'%')
            ->orWhere('description','like', '%'.$request->search.'%')->get();

        $resp = array();
        foreach ($script as $item){
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
        $script = Script::find($id);
        if ($script->user_id == Auth::user()->id) {
            foreach ($script->kommentar as $comment){
                $comment->delete();
            }
            $script->delete();
        }

        return Redirect::to('script');
    }
}
