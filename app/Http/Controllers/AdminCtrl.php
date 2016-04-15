<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Block;
use App\Script;
use App\Http\Requests;
use Auth;
use URL;
use View;

class AdminCtrl extends Controller
{
    public function index()
    {
        $blocks = Block::orderBy('updated_at')
                         ->take(5)
                         ->get();
        $scripts = Script::orderBy('updated_at')
                         ->take(5)
                         ->get();

        return View::make('admin.index')->with('blocks',$blocks)->with('scripts',$scripts);

    }

    public function getNews($isScript) {
        $return = '';
        if($isScript == 2 || $isScript == 1){
            $empty = true;
            $return .= '<h5>Scripts</h5>';
            $html = '';
            foreach (Auth::user()->scripts as $script){
                $empty = false;
                $count_new = app('App\Http\Controllers\CommentCtrl')->getNew($script->id,true);
                if ($count_new > 0){
                    $html .= '<li>'.$count_new.' new comments: <a href="'.URL::to('/script/'.$script->id).'">'.$script->name.'</a></li>';
                }
            }
            if (!$empty)
                $return .='<ul style="list-style: none">'.$html.'</ul>';
            else
                $return .= 'No new comments';
        }
        if($isScript == 2 || $isScript == 0){
            $empty = true;
            $return .= '<h5>Blocks</h5>';
            $html = '';
            foreach (Auth::user()->blocks as $block){
                $empty = false;
                $count_new = app('App\Http\Controllers\CommentCtrl')->getNew($block->id,false);
                if ($count_new > 0){
                    $html .= '<li>'.$count_new.' new comments: <a href="'.URL::to('/block/'.$block->id).'">'.$block->name.'</a></li>';
                }
            }


            if (!$empty)
                $return .='<ul style="list-style: none">'.$html.'</ul>';
            else
                $return .= 'No new comments';
        }
        return $return;
    }
}
