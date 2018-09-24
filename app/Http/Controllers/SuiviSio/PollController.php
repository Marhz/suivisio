<?php

namespace App\Http\Controllers\SuiviSio;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

use App\Models\Group;

class PollController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $user = Auth::user();
      $poll = $user->getPoll();
      return view('poll.index', compact('user', 'poll'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $user = Auth::user();
      $polls = $user->group->course->polls->pluck('name','id');
      return view('poll.edit', compact('user', 'polls'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $user = Auth::user();
      $user->polls()->sync($request->input('polls'));
      return redirect()->route('poll.index')->with('success','Vos voeux ont été enregistrés');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $group = Group::findOrFail($id);
      return view('poll.show', compact('group'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $user = Auth::user();
      $poll = $user->getPoll();
      $polls = $user->group->course->polls->pluck('name','id');;
      return view('poll.edit', compact('user', 'poll', 'polls'));
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
      $user = Auth::user();
      if($user->$id == $id)
      {
        $user->polls()->sync($request->input('polls'));
        return redirect()->route('poll.index')->with('success','Vos voeux ont été enregistrés');
      }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        redirect()->route('poll.index');
    }
}
