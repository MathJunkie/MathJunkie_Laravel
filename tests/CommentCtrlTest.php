<?php

use App\Kommentar;
use App\User;
use PHPUnit_Framework_Assert as PHPUnit;
use App\Http\Controllers\CommentCtrl;
class CommentCtrlTest extends TestCase{
    /** @test */
    public function testBlockComment(){
        //Get a User that made a comment and see if the Commentcontroller registers that
        $kommentar = Kommentar::where('commentable_type','=','App\\Block')->first();

        $id = $kommentar->commentable_id;


        $comment = new CommentCtrl();
        $count = $comment->getNew($id,false);


        PHPUnit::isTrue($count>0);
    }

    public function testScriptComment(){
        //Get a User that made a comment and see if the Commentcontroller registers that
        $kommentar = Kommentar::where('commentable_type','=','App\\Script')->first();

        $id = $kommentar->commentable_id;


        $comment = new CommentCtrl();
        $count = $comment->getNew($id,true);


        PHPUnit::isTrue($count>0);
    }
}