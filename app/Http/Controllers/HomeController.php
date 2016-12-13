<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(\Auth::guest())
            return view('auth.login');
/*        $categories = \Auth::user()->group->course->getCategories();
        $userActivities = \Auth::user()->getActivitiesId();
        foreach($categories as $category){
            foreach ($category->activities as $activity){
                if(in_array($activity->id, $userActivities))
                    echo 'Y - '.$activity->nomenclature.' ';
                else
                    echo 'N - '.$activity->nomenclature.' ';
            }
        }*/
        // $main_activities = \App\MainActivity::with('activities')->get();
        // $userActivities = \Auth::user()->getActivitiesId();
        // foreach($main_activities as $main_activity)
        // {
        //     $activitiesId = $main_activity->activities->pluck('id')->toArray();
        //     if ((array_intersect($userActivities, $activitiesId)))
        //         echo $main_activity->name.'Y';
        //     else
        //         echo $main_activity->name.'N';
        //     echo '<br/>';
        // }
        // die();
        return view('home');
    }
}
