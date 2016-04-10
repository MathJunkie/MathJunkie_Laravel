<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Block;
use App\Script;
use App\Http\Requests;
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
}
