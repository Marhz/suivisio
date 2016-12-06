<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Situation;
use App\Http\Requests\SituationRequest;

class SituationController extends Controller
{
	public function __construct()
	{
		$this->middleware('student')->only('create','store');
	}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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
        $situation = new Situation($request->except('begin_at','end_at','_token','rephrasing'));
        $situation->user_id = \Auth::user()->id;
        $situation->begin_at = \Carbon::createFromFormat('d/m/Y', $request->input('begin_at'));
        $situation->end_at = \Carbon::createFromFormat('d/m/Y',$request->input('end_at'));
        $situation->save();
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
        $situation = Situation::find($id);
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
        $situation = Situation::where('user_id','=',\Auth::user()->id)->find($id);
        $situation->name = $request->input('name');
        $situation->description = $request->input('description');
        $situation->source_id = $request->input('source_id');
        $situation->begin_at = \Carbon::createFromFormat('d/m/Y',$request->input('begin_at'));
        $situation->end_at = \Carbon::createFromFormat('d/m/Y',$request->input('end_at'));
        $situation->save();
        $situation->activities()->sync($request->input('activity_list'));
        $this->addRephrasing($situation,$request->input('rephrasing'));
        return redirect()->action('SituationController@index')->with('success','Situation '.$situation->name.' modifiée avec succès');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
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
}
