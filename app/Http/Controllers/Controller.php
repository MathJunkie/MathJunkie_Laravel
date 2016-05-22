<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Block;
use App\Script;

abstract class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function sendStatus($message) {
        return redirect()->back()->with('status',$message)->withInput(array('email'));
    }

    protected function getSearchJson($type, $search) {
        if ($type === "Script") {
            $obj = Script::where('name', 'like', '%'.$search.'%')
                           ->orWhere('description', 'like', '%'.$search.'%')->get();
        }
        else {
            $obj = Block::where('name', 'like', '%'.$search.'%')
                           ->orWhere('description', 'like', '%'.$search.'%')->get();
        }
        $resp = array();
        foreach ($obj as $item){
            $entry = [
                "description" => $item->description,
                "name" => $item->name,
                "id" => $item->id,
            ];
            array_push($resp, $entry);
        }
        return $resp;
    }

    protected function destroyObj($type, $id) {
        if ($type === "script") {
            $obj = Script::find($id);
        }
        else {
            $obj = Block::find($id);
        }
        if ($obj->user_id == Auth::user()->id) {
            foreach ($obj->comments as $comment) {
                $comment->delete();
            }
            $obj->delete();
        }
        return Redirect::to($type);
    }
}
