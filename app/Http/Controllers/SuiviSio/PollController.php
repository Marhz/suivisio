<?php

namespace App\Http\Controllers\SuiviSio;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

use App\Models\Group;
use App\Models\Poll;

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
      if ($user->can('view', Poll::class))
      {
        $poll = $user->getPoll();
        return view('poll.index', compact('user', 'poll'));
      }
      else
        return redirect()->back();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $user = Auth::user();
      if ($user->can('edit', Poll::class))
      {
        $polls = $user->group->course->polls->pluck('name','id');
        return view('poll.edit', compact('user', 'polls'));
      }
      else
        return redirect()->back();
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
      if ($user->can('edit', Poll::class))
      {
        $user->polls()->sync($request->input('polls'));
        return redirect()->route('poll.index')->with('success','Vos voeux ont été enregistrés');
      }
      else
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $user = Auth::user();
      $group = Group::findOrFail($id);
      if ($user->can('viewPoll', $group))
        return view('poll.show', compact('group'));
      else
        return redirect()->back();
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
      if ($user->can('edit', Poll::class))
      {
        $poll = $user->getPoll();
        $polls = $user->group->course->polls->pluck('name','id');;
        return view('poll.edit', compact('user', 'poll', 'polls'));
      }
      else
        return redirect()->back();
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
      if ($user->can('edit', Poll::class))
      {
        $user->polls()->sync($request->input('polls'));
        return redirect()->route('poll.index')->with('success','Vos voeux ont été enregistrés');
      }
      else
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return redirect()->back();
    }
}
