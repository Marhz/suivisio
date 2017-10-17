<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('isOwnerOfSituation')->only('store');
    }

    public function store(Request $request,$situationId)
    {
    	$comment = \Auth::user()->comments()->create($request->input());
    	$comment->situation_id = $situationId;
    	$comment->save();
    	return redirect()->back();
    }
    public function destroy(Comment $comment)
    {
        if(\Auth::user()->isAdmin() ||\Auth::user()->id == $comment->user_id) {
            $comment->delete();
        }
    	return redirect()->back();
    }
}
