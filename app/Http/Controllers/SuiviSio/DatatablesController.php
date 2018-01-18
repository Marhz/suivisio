<?php

namespace App\Http\Controllers\SuiviSio;

use Illuminate\Http\Request;
use Datatables;
use App\Models\Group;
use App\Models\Activity;
use App\Models\Situation;
use App\Http\Controllers\Controller;


class DatatablesController extends Controller
{
    public function showGroupDatatables($id)
    {
        $group = Group::find($id);
        return Datatables::of($group->users()->get())
        	->editColumn('actions',function ($user){
        		return
                    /*$this->showBtn('users',$user->id).*/
                    $this->editBtn('users',$user->id).
                    $this->deleteBtn('users',$user->id);
        	})
            ->make(true);
    }
    public function showActivitiesDatatables()
    {
        $activities = Activity::with('category.course')->select('activities.*');
/*        $activities = \App\Activity::
            join('activity_category','activities.id','=','activity_category.activity_id')
            ->join('categories','categories.id','=','activity_category.category_id')
            ->join('courses','courses.id','=','categories.course_id')->select('*');
*/        return Datatables::of($activities)
            ->editColumn('category.nomenclature',function($activity){
                if(isset($activity->category->first()->nomenclature))
                    return $activity->category->first()->nomenclature;
                return 'Aucune';
            })
            ->editColumn('category.course_id',function($activity){
                $result = '';
                foreach($activity->category as $category)
                {
                    $result .= (isset($category->course_id) ? ' '.$category->course->name : 'indifférencié');
                    $result .='<br/>';
                }
                return $result;
            })
            ->editColumn('Actions',function ($activity){
                return
                    $this->editBtn('activites',$activity->id).
                    $this->deleteBtn('activites',$activity->id);
            })
            ->make(true);
    }
     public function showSituationsDatatables()
    {
        $situations = Situation::getTeacherSituations()->get();
            return Datatables::of($situations)
            ->editColumn('user.name',function($situation){
                return $situation->user->fullName();
            })
            ->editColumn('group',function($situation){
                return $situation->user->group->name;
            })
            ->editColumn('updated_at', function($situation){
                \Carbon\Carbon::setLocale('fr');
                return "<span class='hidden'>{$situation->updated_at->timestamp}</span>".$situation->updated_at->diffForHumans();
            })
            ->editColumn('viewed',function($situation){
                $viewed[0] = $situation->viewed ? '1' : '0';
                $viewed[1] = $situation->viewed ? 'eye' : 'eye-slash';
                return "<span class='fa-color'><span class='hidden'>{$viewed[0]}</span><i class='fa fa-{$viewed[1]}'></i></span>";
            })
            ->editColumn('Actions',function ($situation){
                  return $this->showBtn('situation',$situation->id);
            })
            ->make(true);
    }
    protected function showBtn($name, $id, $prefix = null)
    {
        return "<a href='".url($prefix."/".$name."/".$id)."'><button class='btn btn-primary actionButton'><i class='fa fa-eye'></i></button></a>";
    }
    protected function deleteBtn($name, $id, $prefix = null)
    {
       return '<form method="post" action="'.url($prefix.'/'.$name.'/'.$id).'" class="deleteBtn">
               '.csrf_field().'
               <input name="_method" type="hidden" value="DELETE">
               <button type="submit" class="btn btn-danger actionButton"><i class="fa fa-trash"></i></button>
           </form>';
    }
    protected function editBtn($name, $id, $prefix = null)
    {
        return "<a href='".url($prefix."/".$name."/".$id.'/edit')."'><button class='btn btn-warning actionButton'><i class='fa fa-edit'></i></button></a>";
    }
}
