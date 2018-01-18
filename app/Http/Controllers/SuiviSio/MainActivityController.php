<?php

namespace App\Http\Controllers\SuiviSio;

use Illuminate\Http\Request;
use App\Models\MainActivity;
use App\Models\Activity;
use App\Http\Controllers\Controller;


class MainActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $main_activities = MainActivity::with('activities')->get();
        return view('main_activities.list', compact('main_activities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $activities = Activity::all();
        $activities = $this->prepareForSelect($activities);
        return view('main_activities.create-edit', compact('activities'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $main_activity = MainActivity::create($request->except('activity_list'));
        $this->syncActivities($request->input('activity_list'),$main_activity->id);
        return redirect()->route('activites_principales.index')->with('success', 'Activité principale crée avec succès');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    	$main_activity = MainActivity::findOrFail($id);
        $activities = Activity::all();
        $activities = $this->prepareForSelect($activities);
        return view('main_activities.create-edit', compact('activities', 'main_activity'));
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
        $main_activity = MainActivity::find($id);
        $main_activity->update($request->except('activity_list'));
        $this->syncActivities($request->input('activity_list'),$main_activity->id,true);
        return redirect()->route('activites_principales.index')->with('success', 'Activité principale éditée avec succès');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $main_activity = MainActivity::find($id);
        Activity::where('main_activity_id', $main_activity->id)->update(['main_activity_id' => null]);
        $main_activity->delete();
    }
    protected function prepareForSelect($activities)
    {
        foreach($activities as $activity)
            $activity->nomenclature = $activity->fullName();
        $activities = $activities->pluck('nomenclature', 'id');
        return $activities;
    }
    protected function syncActivities($activitiesId, $main_id, $update = false)
    {
    	foreach($activitiesId as $id)
        {
        	Activity::find($id)->update(['main_activity_id' => $main_id]);
        }
        if($update)
        {
        	$activities = Activity::whereNotIn('id', $activitiesId)
        							->where('main_activity_id', $main_id)
        							->update(['main_activity_id' => null]);
        }
    }
}
