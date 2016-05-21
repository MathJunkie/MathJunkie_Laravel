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

    public function print_News($type) {
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
            $CountNew = app('App\Http\Controllers\CommentCtrl')->getNew($o->id, true);
            if ($CountNew == 0){
                continue;
            }
            $empty = false;
            $html .= '<li>'.$CountNew.' new comments: '.
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
                return $this->print_News("block");
            case 1:
                return $this->print_News("script");
            default:
                return $this->print_News("block").$this->print_News("script");
        }
    }
}
