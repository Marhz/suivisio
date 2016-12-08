<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;

class CommentController extends Controller
{
    public function store(Request $request,$situationId)
    {
    	$comment = \Auth::user()->comments()->create($request->input());
    	$comment->situation_id = $situationId;
    	$comment->save();
    	return redirect()->back();
    }
    public function destroy($id)
    {
    	Comment::find($id)->delete();
    	return redirect()->back();
    }
}
