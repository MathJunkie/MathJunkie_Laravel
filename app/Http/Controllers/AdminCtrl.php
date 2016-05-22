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

        return View::make('admin.index')->with('blocks',$blocks)
                                        ->with('scripts',$scripts)
                                        ->with('hasComment',app('App\Http\Controllers\CommentCtrl')
                                        ->hasComment(2));

    }

    public function printNews($type) {
        $empty = true;
        $return = '<h5>'.ucfirst($type).'</h5>';
        if ( $type === "script" ){
            $obj = Auth::user()->scripts;
        }
        else {
            $obj = Auth::user()->blocks;
        }
        $html = '';
        foreach ( $obj as $o ){
            $countNew = app('App\Http\Controllers\CommentCtrl')->getNew($o->id, true);
            if ($countNew == 0){
                continue;
            }
            $empty = false;
            $html .= '<li>'.$countNew.' new comments: '.
                         '<a href="'.URL::to('/'.$type.'/'.$o->id).'">'.$o->name.'</a>'.
                     '</li>';
        }
        if ( $empty  === false) {
            $return .='<ul style="list-style: none">'.$html.'</ul>';
        }
        else {
            $return .= 'No new comments';
        }
        return $return;
    }

    public function getNews( $isScript ) {
        switch ($isScript) {
            case 0:
                return $this->printNews("block");
            case 1:
                return $this->printNews("script");
            default:
                return $this->printNews("block").$this->printNews("script");
        }
    }
}
