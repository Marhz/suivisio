<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Group;
use App\Http\Requests\GroupRequest;

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
        $teachers = \App\User::teachers()->get()->pluck('last_name','id');
        $courses = \App\Course::all()->pluck('name','id');
        return view('groups.create-edit',compact('teachers','courses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GroupRequest $request)
    {
        $group = Group::create($request->except('teacher_list'));
        $teachers = ($request->input('teacher_list')) ? $request->input('teacher_list') : [];
        $group->teachers()->sync($teachers);
        return redirect()->route('classes.index')->with('success','La classe a été crée avec succès');
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
        return view('groups.show', compact('group'));
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
        $teachers = \App\User::where('level','<',2)->get()->pluck('last_name','id')->toArray();
        $courses = \App\Course::all()->pluck('name','id');
        return view('groups.create-edit',compact('teachers','courses','group'));
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
        $group->update($request->input());
        $teachers = ($request->input('teacher_list')) ? $request->input('teacher_list') : [];
        $group->teachers()->sync($teachers);
        return redirect()->route('classes.index')->with('success','La classe a été modifiée avec succès');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(GroupRequest $request,$id)
    {
        $users = \App\User::where('group_id','=',$id)->get();
        foreach($users as $user)
        {
            $user->group_id = null;
            $user->save();
        }
        Group::find($id)->delete();
        return redirect()->route('classes.index');
    }
}
