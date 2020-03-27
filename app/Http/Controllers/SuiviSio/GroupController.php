<?php

namespace App\Http\Controllers\SuiviSio;

use App\Models\Document;
use Illuminate\Http\Request;
use Auth;
use App\Models\Group;
use App\Models\User;
use App\Models\Course;
use App\Models\Year;
use App\Http\Requests\GroupRequest;
use App\Http\Controllers\Controller;

use App\Events\Document\DocumentOpenedEvent;

use Carbon\Carbon;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $groups = Group::with('course')->get();
        return view('groups.list')->with('groups', $groups);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      if (Auth::user()->can('create', Group::class))
      {
        $documents = Document::all()->pluck('name','id');
        $teachers = User::teachers()->get()->pluck('last_name','id');
        $courses = Course::all()->pluck('name','id');
        return view('groups.create-edit',compact('teachers','courses', 'documents'));
      }
      return redirect()->back();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GroupRequest $request)
    {
      if (Auth::user()->can('create', Group::class))
      {
        $group = Group::create($request->except('teacher_list'));
        $group->year()->associate(Year::current());
        $teachers = ($request->input('teacher_list')) ? $request->input('teacher_list') : [];
        $group->teachers()->sync($teachers);
        $documents = ($request->input('document_list')) ? $request->input('document_list') : [];
        $group->documents()->sync($documents);
        return redirect()->route('classes.index')->with('success','La classe a été crée avec succès');
      }
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
      $group = Group::findOrFail($id);
      if (Auth::user()->can('view', $group))
        return view('groups.show', compact('group'));
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
      $group = Group::find($id);
      if (Auth::user()->can('edit', $group))
      {
        $documents = Document::all()->pluck('name','id')->toArray();
        $teachers = User::where('level','<',2)->get()->pluck('last_name','id')->toArray();
        $courses = Course::all()->pluck('name','id');
        return view('groups.create-edit',compact('teachers','courses','group', 'documents'));
      }
      return redirect()->back();
    }

  public function editDeadLines($id)
  {
    $group = Group::find($id);
    if (Auth::user()->can('edit', $group))
    {
      $documents = $group->documents;
      return view('groups.deadlines',compact('group', 'documents'));
    }
    return redirect()->back();
  }

  /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(GroupRequest $request, $id)
    {
      $group = Group::find($id);
      if (Auth::user()->can('edit', $group))
      {
        $group->update($request->input());
        $teachers = ($request->input('teacher_list')) ? $request->input('teacher_list') : [];
        $group->teachers()->sync($teachers);
        $documents = ($request->input('document_list')) ? $request->input('document_list') : [];
        $group->documents()->sync($documents);
        return redirect()->route('classes.index')->with('success','La classe a été modifiée avec succès');
      }
      return redirect()->back();
    }

  public function updateDeadLines(Request $request, $id)
  {
    $group = Group::find($id);
    if (Auth::user()->can('edit', $group))
    {
      $group->update($request->input());
      foreach ($group->documents as $document)
      {
        $previous_dead_line = $group->documents()->where('document_id', $document->id)->first()->pivot->deadline;
        $new_dead_line = $request->input($document->id);
        $group->documents()->updateExistingPivot($document->id, ['deadline' => new Carbon($new_dead_line)]);
	$now = Carbon::now()->toDateString();
        if ($previous_dead_line != $new_dead_line && $previous_dead_line <= $now && $now <= new_dead_line)
          event(new DocumentOpenedEvent($group, $document));
      }
      return redirect('classes/'.$group->id.'/')->with('success','La classe a été modifiée avec succès');
    }
    return redirect()->back();
  }

  /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(GroupRequest $request,$id)
    {
      $group = Group::find($id);
      if (Auth::user()->can('delete', $group))
      {
        $users = User::where('group_id','=',$id)->get();
        foreach($users as $user)
        {
            $user->group_id = null;
            $user->save();
        }
        $group->delete();
        return redirect()->route('classes.index');
      }
      else
        return redirect()->back();
    }

}
