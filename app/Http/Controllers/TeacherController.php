<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Group;
use App\Http\Requests\UserRequest;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $teachers = User::teachers()->get();
        return view('users.teacher-list', compact('teachers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $groups = Group::all()->pluck('name','id');
        return view('users.teacher-create-edit',compact('groups'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $user = User::create($request->except('group_list'));
        $user->level = 1;
        $user->save();
        $user->accountCreated();
        $groups = $request->input('group_list') ? $request->input('group_list') : [];
        $user->teacherOf()->sync($groups);
        return redirect()->route('professeurs.index')->with('success','Le professeur '.$user->fullName().' a été crée avec succès');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $user = User::findOrFail($id);
      $groups = Group::all()->pluck('name','id');
      return view('users.teacher-view',compact('groups', 'user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $teacher = User::findOrFail($id);
        $groups = Group::all()->pluck('name','id');
        return view('users.teacher-create-edit',compact('groups', 'teacher'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {
        $user = User::findOrFail($id);
        $user->update($request->except('group_list'));
        $groups = $request->input('group_list') ? $request->input('group_list') : [];
        $user->teacherOf()->sync($groups);
        return redirect()->route('professeurs.index')->with('success','Le professeur '.$user->fullName().' a été modifié avec succès');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
