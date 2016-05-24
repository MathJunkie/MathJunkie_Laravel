<?php

namespace App\Http\Controllers;

use App\Category_color;
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
        $script = Script::where('name', '=', $request->search)->first();
        if ( empty($script) ) {
            //richtig
            if (Auth::check())
            {
                $script = new Script();
                $script->name = $request->search;
                $script->structure = "<xml><block type=\"input_list\" deletable=\"false\"><next><block type=\"statement_list\" deletable=\"false\"></block></next></block></xml>";
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
    public function show($id, $isSage = null)
    {
        $script = Script::find($id);
        if (empty($script)) {
            return Redirect::to('script')->withErrors('Could not find the script');
        }
        if (empty($isSage)){
            return View::make('script.view')->with('script', $script)->with('isView', true);
        }
        elseif ($isSage === "sage"){
            return View::make('script.sagemath')->with('script', $script->function);
        }
        return View::make('script.sagemath')->with('script', $script->function_temp);
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
                $xml_array = array_merge_recursive($xml_array, $temp);
            }
           $keys = array_keys($xml_array);
           foreach ($keys as $key) {
               if ($key === "Method" || $key === "Variable" || $key === "Base"){
                   continue;
               }
               $color = Category_color::where('name','=',$key)->first();

               if (empty($color)){
                   $xml .= '<category name="'.$key.'" >';
               }
               else{
                   $xml .= '<category colour="'.$color->color.'" name="'.$key.'">';
               }
                $b_item = $xml_array[$key];

               if (!is_array($b_item)) {
                    $xml .= '<block type="'.$b_item.'"></block>';
                }
                else{
                    foreach ($b_item as $item) {
                        $xml .= '<block type="'.$item.'"></block>';
                    }
                }
                $xml .= '</category>';
            }
            $xml .= '<sep></sep>';
            $xml .= '<category name="Variables" colour = "'.Category_color::where('name', '=', 'Variable')->first()->color.'" custom="VARIABLE"></category>
                     <category name="Functions" colour = "'.Category_color::where('name', '=', 'Method')->first()->color.'"custom="PROCEDURE"></category>';
            $xml .= '</xml>';
            $color = category_color::all();
            $color_script = '<script>';
            $color_script .= 'window.ColorArray= {};';
            foreach ($color as $c){
                $color_script .= 'window.ColorArray[\'' . $c->name .'\'] = '.$c->color.';';
            }
            $color_script .= '</script>';
            $xml = $color_script.$xml;
            $content = [];
            $content['xml'] = $xml;
            $content['structure'] = $structure;
            $content['function'] = $function;

            return View::make('script.builder')->with('content', $content)
                                               ->with('script', $script);
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

    public function updatePreview(Request $request, $id){
        $script = Script::find($id);
        if ($script->user_id == Auth::user()->id){
            $script->function_temp = $request->function_temp;
            $script->save();
        }
        else
            return response('You have no privileges to edit anothers script',404);
        return "";
    }

    public function getList(Request $request)
    {
        return response()->json($this->getSearchJson("Script", $request->search));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->destroyObj("script", $id);
    }
}
