<?php

namespace App\Http\Controllers;

use App\Http\Requests\SituationRequest;
use App\Situation;
use Illuminate\Http\Request;

class SituationController extends Controller
{
	public function __construct()
	{
		$this->middleware('student')->only('create','edit');
        $this->middleware('isOwnerOfSituation')->only('show');
	}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(\Auth::user()->isTeacher())
            return $this->teacherIndex();
    	$situations = Situation::getUserSituations()->get();
    	return view('situations.list',compact('situations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $activities = \App\Activity::all();
        $activities = $this->prepareForSelect($activities);
    	$sources = \App\Source::all()->pluck('label','id');
        return view('situations.create-edit',compact('activities','sources'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SituationRequest $request)
    {
        $data = $this->prepareData($request->except('_token','rephrasing'));
        $situation = Situation::create($data);
        $situation->activities()->sync($request->input('activity_list'));
        $this->addRephrasing($situation,$request->input('rephrasing'));
        return redirect()->action('SituationController@index')
        				 ->with('success','Situation '.$situation->name.' ajoutée avec succès');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $situation = Situation::with('comments.user')->findOrFail($id);
        if(\Auth::user()->isTeacher()){
            $situation->viewed = 1;
            $situation->timestamps = false;
            $situation->save();
        }
        return view('situations.show',compact('situation'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $situation = Situation::where('user_id','=',\Auth::user()->id)->find($id);
        $activities = \App\Activity::all();
        $activities = $this->prepareForSelect($activities);
    	$sources = \App\Source::all()->pluck('label','id');
        return view('situations.create-edit',compact('situation','activities','sources'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SituationRequest $request, $id)
    {
        $data = $this->prepareData($request->except('_token','rephrasing'));
        $situation = Situation::find($id);
        $situation->update($data);
        $situation->activities()->sync($request->input('activity_list'));
        $this->addRephrasing($situation,$request->input('rephrasing'));
        return redirect()->action('SituationController@index')
            ->with('success','Situation '.$situation->name.' modifiée avec succès');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(SituationRequest $request,$id)
    {
        $situation = Situation::find($id);
        $situation->delete();
        return redirect()->action('SituationController@index')->with('success','Situation '.$situation->name.' éffacée avec succès');
    }
    protected function prepareForSelect($activities)
    {
    	foreach($activities as $activity)
            $activity->nomenclature = $activity->fullName();
        $activities = $activities->pluck('nomenclature', 'id');
        return $activities;
    }
    protected function addRephrasing($situation,$rephrasing)
    {
        foreach($situation->activities as $activity)
        {
            $activity->pivot->rephrasing = $rephrasing[$activity->id];
            $activity->pivot->save();
        }
    }
    protected function prepareData($data)
    {
        $data['user_id'] = \Auth::user()->id;
        $data['begin_at'] = \Carbon::createFromFormat('d/m/Y', $data['begin_at']);
        $data['end_at'] = \Carbon::createFromFormat('d/m/Y',$data['end_at']);
        $data['viewed'] = 0;
        return $data;
    }
    protected function teacherIndex()
    {
        return view('situations.teacher-list',compact('situations'));
    }
}
