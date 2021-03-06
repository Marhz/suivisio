<?php

namespace App\Http\Controllers\SuiviSio;

use Illuminate\Http\Request;
use Datatables;
use App\Models\User;
use App\Models\Activity;
use App\Models\Group;
use App\Models\Situation;
use App\Models\MacAddress;
use App\Http\Controllers\Controller;


class DatatablesController extends Controller
{
    public function showGroupDatatables($id)
    {
        $group = Group::find($id);
        return Datatables::of($group->users()->get())
          ->addColumn('statut',
            function (User $user)
            {
              return $this->statut($user);
            })
          ->addColumn('documents',
            function (User $user)
            {
              return $this->documents($user);
            })
          ->editColumn('actions',function ($user){
        		return
                    $this->showBtn('users',$user->id, null, '/situations').
                    $this->editBtn('users',$user->id).
                    $this->deleteBtn('users',$user->id).
                    $this->pdfBtn('users',$user);
        	})
          ->make(true);
    }

  public function showUsersDatatables()
  {
    $users = User::all();
    return Datatables::of($users)
        ->addColumn('group',
            function (User $user)
            {
              return $user->group != null ? $user->group->name : 'Prof';
            })
        ->addColumn('year',
            function (User $user)
            {
              return $user->group != null && $user->group->year != null ? $user->group->year->name : '';
            })
        ->editColumn('actions',function ($user){
          if ($user->isStudent())
            return $this->editBtn('users',$user->id).
                $this->deleteBtn('users',$user->id).
                $this->pdfBtn('users',$user).
                $this->showBtn('users',$user->id, null, '/situations');
          else
            return $this->editBtn('professeurs',$user->id);

        })
        ->make(true);
  }

  public function showActivitiesDatatables()
    {
        $activities = Activity::with('category.course')->select('activities.*');
        return Datatables::of($activities)
            ->editColumn('category.nomenclature',function($activity){
                if(isset($activity->category->first()->nomenclature))
                    return $activity->category->first()->nomenclature;
                return 'Aucune';
            })
            ->editColumn('category.course_id',function($activity){
                return view('activities.datatables.courses')->with(compact('activity'))->render();
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
            ->editColumn('user.name', function($situation){
                return $situation->user->fullName();
            })
            ->editColumn('group', function($situation){
                return $situation->user->group->name;
            })
            ->editColumn('updated_at', function($situation){
                return view('situations.datatables.updated_at')->with(compact('situation'))->render();
            })
            ->editColumn('viewed', function($situation){
                return view('situations.datatables.viewed')->with(compact('situation'))->render();
            })
            ->editColumn('Actions', function ($situation){
                  return $this->showBtn('situation', $situation->id);
            })
            ->make(true);
    }

    public function showMacAddressesDatatables($id)
    {
        $group = Group::find($id);
        return Datatables::of($group->getUsersAndMacAddresses())
          ->addColumn('Utilisateur',
          function (MacAddress $macAddress)
          {
            return $macAddress->user->FullName()
             .((isset($macAddress->label) ? " (".$macAddress->label.")" : ""));
          })
          ->make(true);
    }

    public function showPollDatatables($id)
    {
        $group = Group::find($id);
        return Datatables::of($group->users)
          ->editColumn('first_name', function($user){
            return $user->fullName();
          })
          ->addColumn('Voeux',
          function (User $user)
          {
            $poll = $user->getPoll();
            return ($poll != null)? $poll->name : "N'a pas répondu au sondage";
          })
          ->make(true);
    }

  private function functionDocumentIcon($document)
  {
    return function (User $user) use ($document)
        {
          $doc = $user->documents()->where('document_id', $document->id)->first();
          $pivot = ($doc!= null) ? $doc->pivot : null;
          return view('documents.partials.status')
            ->with(['pivot' => $pivot])
            ->render();
        };
  }

  public function showDocumentsDatatables($classid, $documentid)
  {
    $group = Group::find($classid);
    $document = $group->documents()->where('id', $documentid)->first();
    return Datatables::of($group->users)
      ->editColumn('name', function($user)
      {
        return $user->fullName();
      })
      ->addColumn('file_name', $this->functionDocumentIcon($document))
      ->make(true);
  }

  protected function documents($user)
    {
      return view('datatables.user_documents')->with(compact('user'))->render();
    }

  protected function statut($user)
  {
    return view('datatables.user_statut')->with(compact('user'))->render();
  }

  protected function showBtn($name, $id, $prefix = null, $suffix = null)
    {
        return view('datatables.show')->with(compact('name', 'id', 'prefix', 'suffix'))->render();
    }

    protected function deleteBtn($name, $id, $prefix = null)
    {
      return view('datatables.delete')->with(compact('name', 'id', 'prefix'))->render();
    }

    protected function editBtn($name, $id, $prefix = null)
    {
        return view('datatables.edit')->with(compact('name', 'id', 'prefix'))->render();
    }

    protected function pdfBtn($name, $user, $prefix = null)
    {
        return view('datatables.pdf')->with(compact('name', 'user', 'prefix'))->render();
    }
}
