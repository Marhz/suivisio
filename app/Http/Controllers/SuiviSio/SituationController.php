<?php

namespace App\Http\Controllers\SuiviSio;

use App\Http\Requests\SituationRequest;
use App\Models\Situation;
use App\Models\Source;
use App\Models\Activity;
use App\Http\Controllers\Controller;
use Auth;
use User;
use Carbon;
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
			$user = Auth::user();
      if($user->isTeacher())
      	return $this->teacherIndex();
    	$situations = Situation::getUserSituations()->get();
    	return view('situations.list',compact('situations', 'user'));
    }

		public function forUser(Request $request, $user_id)
    {
			$user = User::findOrFail($user_id);
			//dd($user);
    	$situations = $user->situations;
    	return view('situations.list', compact('situations', 'user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
			$user = Auth::user();
			if ($user->can('addSituation', $user))
			{
	        $activities = Activity::all();
	        $activities = $this->prepareForSelect($activities);
	    		$sources = Source::all()->pluck('label','id');
	        return view('situations.create-edit',compact('activities','sources'));
			}
			else
					return $this->index();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SituationRequest $request)
    {
			$user = Auth::user();
			if ($user->can('addSituation', $user))
			{
	        $data = $this->prepareData($request->except('_token','rephrasing'));
	        $situation = Situation::create($data);
	        $situation->activities()->sync($request->input('activity_list'));
	        $this->addRephrasing($situation,$request->input('rephrasing'));
	        return redirect()->action('SuiviSio\SituationController@index')
	        				 ->with('success','Situation '.$situation->name.' ajoutée avec succès');
			 }
 			else
 					return $this->index();
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
			$situation = Situation::with('comments.user')->findOrFail($id);
			if ($user->can('view', $situation))
			{
		      if(Auth::user()->isTeacher()){
		          $situation->viewed = 1;
		          $situation->timestamps = false;
		          $situation->save();
		      }
		      return view('situations.show',compact('situation'));
			}
		 else
				 return $this->index();
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
			$situation = Situation::where('user_id', '=', Auth::user()->id)->find($id);
			if ($user->can('edit', $situation))
			{
	        $activities = Activity::all();
	        $activities = $this->prepareForSelect($activities);
	    		$sources = Source::all()->pluck('label','id');
	        return view('situations.create-edit',compact('situation','activities','sources'));
				}
  			else
  					return $this->index();
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
			$user = Auth::user();
			$situation = Situation::where('user_id', '=', Auth::user()->id)->find($id);
			if ($user->can('edit', $situation))
			{
	        $data = $this->prepareData($request->except('_token','rephrasing'));
	        $situation->update($data);
	        $situation->activities()->sync($request->input('activity_list'));
	        $this->addRephrasing($situation,$request->input('rephrasing'));
	        return redirect()->action('SuiviSio\SituationController@index')
	            ->with('success','Situation '.$situation->name.' modifiée avec succès');
			}
			else
					return $this->index();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
				$user = Auth::user();
				$situation = Situation::where('user_id', '=', Auth::user()->id)->find($id);
				if ($user->can('delete', $situation))
				{
	        $situation = Situation::find($id);
	        $situation->delete();
	        return redirect()->action('SuiviSio\SituationController@index')->with('success','Situation '.$situation->name.' éffacée avec succès');
				}
				else
						return $this->index();
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
        $data['user_id'] = Auth::user()->id;
        $data['begin_at'] = Carbon::createFromFormat('d/m/Y', $data['begin_at']);
        $data['end_at'] = Carbon::createFromFormat('d/m/Y',$data['end_at']);
        $data['viewed'] = 0;
        return $data;
    }

    protected function teacherIndex()
    {
        return view('situations.teacher-list',compact('situations'));
    }
}
