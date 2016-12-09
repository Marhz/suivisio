<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Datatables;
class DatatablesController extends Controller
{
    public function showGroupDatatables($id)
    {
        $group = \App\Group::find($id);
        return Datatables::of($group->users()->get())
        	->editColumn('actions',function ($user){
        		$viewBtn = "<a href=''><button class='btn btn-primary'><i class='fa fa-eye'></i></button></a> ";
        		$editBtn = "<a href='".url('users/'.$user->id.'/edit')."'><button class='btn btn-warning'><i class='fa fa-edit'></i></button></a> ";
        		$deleteBtn = '<form method="post" action="'.url('users/'.$user->id).'">
        						'.csrf_field().'
        						<input name="_method" type="hidden" value="DELETE">
        						<button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>
        					</form>';
        		$buttons = $viewBtn.$editBtn.$deleteBtn;
        		return $buttons;
        	})
            ->make(true);
    }
    public function showActivitiesDatatables()
    {
        $activities = \App\Activity::all();
        return Datatables::of($activities)
            ->editColumn('Parcours',function($activity){
                $result = '';
                foreach($activity->category as $category)
                {
                    $result .= $category->nomenclature;
                    $result .= (isset($category->course_id) ? ' '.$category->course->name : null);
                    $result .='<br/>';
                }                
                return $result;
            })
            ->editColumn('Actions',function ($activity){
                $viewBtn = "<a href=''><button class='btn btn-primary'><i class='fa fa-eye'></i></button></a> ";
                $editBtn = "<a href='".url('users/'.$activity->id.'/edit')."'><button class='btn btn-warning'><i class='fa fa-edit'></i></button></a> ";
                $deleteBtn = '<form method="post" action="'.url('users/'.$activity->id).'">
                                '.csrf_field().'
                                <input name="_method" type="hidden" value="DELETE">
                                <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                            </form>';
                $buttons = $viewBtn.$editBtn.$deleteBtn;
                return $buttons;
            })
            ->make(true);
    }
}
