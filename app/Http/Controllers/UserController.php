<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Group;
use Auth;
use Excel;
use App\Http\Requests\UserRequest;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('users.admin-list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return redirect('/');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return redirect('/');
        /*
        $groups = Group::all()->pluck('name','id');
        $user = User::find($id);
        return view('users.view',compact('groups','user'));
        */
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $groups = Group::all()->pluck('name','id');
        $user = User::find($id);
        return view('users.edit',compact('groups','user'));
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
        User::find($id)->update($request->input());
        $user = User::find($id);
        return redirect()->back()
                         ->with('success','L\'utilisateur '.$user->email.' a été modifié avec succès');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserRequest $request,$id)
    {
        $user = User::find($id);
        $user->situations()->delete();
        $user->delete();
        return redirect()->back()->with('success','L\utilisateur '.$user->email.' a été effacé avec succès');
    }

    public function OdsImport(Request $request,$id)
    {
        if($request->hasFile('ods'))
        {
            $path = $request->file('ods')->getRealPath();
            $data = Excel::load($path, function($reader) {})->get();
            if(!empty($data) && $data->count())
            {
                foreach($data->toArray() as $key => $values)
                {
                    if(!empty($values))
                        $this->addFromOds($values,$id);
                }
            }
            return back()->with('success', 'Le fichier a été ajouté correctement');
        }
        return back()->with('error', 'Un problème est survenu durant l\'upload du fichier');
    }

    protected function addFromOds($values,$id)
    {
        foreach($values as $value)
        {
            if($user = User::where('email', '=', $value['mail'])->first())
                $this->updateFromOds($user,$value,$id);
            else
            {
                $user = new User;
                $user->last_name = $value['nom'];
                $user->first_name = $value['prenom'];
                $user->email = $value['mail'];
                $user->group_id = $id;
                $user->save();
            }
        }
    }

    protected function updateFromOds($user,$value,$id)
    {
        $user->last_name = $value['nom'];
        $user->first_name = $value['prenom'];
        $user->group_id = $id;
        return $user->save();
    }

    public function get_addUserInGroup($id)
    {
        $group = Group::find($id);
        return view('groups.addUser',compact('group'));
    }

    public function post_addUserInGroup(UserRequest $request)
    {
        $user = User::create($request->input());
        $user->save();
        $group = Group::find($request->input('group_id'));
        return redirect()->action('SuiviSio\GroupController@show',$request->input('group_id'))
                         ->with('success','L\'utilisateur '.$user->email.' a été ajouté avec succès');
    }

    public function editNumeroCandidat(Request $resquest)
    {
        $user = Auth::user();
        if ($user->can('changerNumeroCandidat', $user))
          return view('users.changerNumeroCandidat', ['user' => $user]);
        return redirect()->back();
    }

    public function storeNumeroCandidat(Request $request)
    {
      $user = Auth::user();
      if ($user->can('changerNumeroCandidat', $user))
      {
          $this->validate($request,
          ['numeroCandidat' => config('app.numero_candidat_format')],
          ['portefeuille' => 'url|active_url'],
          ['numeroCandidat.regex' => 'Format du numéro de candidat incorrect : ' . config('app.numero_candidat_format')],
          ['numeroCandidat.url' => 'L\'adresse de votre portefeuille est invalide.']
          );
        $user->update($request->input());
        return redirect()->back()
                         ->with('success','Vos données ont été mises à jour.');
      }
      else
        return redirect()->back();
    }

}
