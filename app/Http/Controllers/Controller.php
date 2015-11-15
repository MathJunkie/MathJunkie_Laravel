<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

abstract class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function sendStatus($message){
        return redirect()->back()->with('status',$message)->withInput(array('email'));
    }

    public function isLoggedIn($request){

    }

    public function getUserName($request){

    }
    public function errorResponse($message){

    }
}
