<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Situation;

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
    	echo "yolo";
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $activities = \App\Activity::all();
        foreach($activities as $activity)
            $activity->formatForSelect();
        $activities = $activities->pluck('nomenclature', 'id');
    	$sources = \App\Source::all()->pluck('label','id');
        return view('situations.create',compact('activities','sources'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $situation = new Situation($request->except('begin_at','end_at','_token'));
        $situation->user_id = \Auth::user()->id;
        $situation->begin_at = \Carbon::createFromFormat('d/m/Y', $request->input('begin_at'));
        $situation->end_at = \Carbon::createFromFormat('d/m/Y',$request->input('end_at'));
        $situation->save();
        $situation->activities()->sync($request->input('activity_list'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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
