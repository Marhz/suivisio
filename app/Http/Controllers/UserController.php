<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
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
        dd('yolo');
        // $users = User::student()->get();
        // return view('users.list')->with('users', $users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        echo "cr";
        //return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        echo "sto";
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $groups = \App\Group::all()->pluck('name','id');
        $user = User::find($id);
        return view('users.view',compact('groups','user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $groups = \App\Group::all()->pluck('name','id');
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
                $user->password = bcrypt(config('app.defaultPassword'));
                $user->group_id = $id;
                $user->save();
                $user->accountCreated();
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
        $group = \App\Group::find($id);
        return view('groups.addUser',compact('group'));
    }

    public function post_addUserInGroup(UserRequest $request)
    {
        $user = User::create($request->input());
        $user->password = bcrypt(config('app.defaultPassword'));
        $user->save();
        $user->accountCreated();
        $group = \App\Group::find($request->input('group_id'));
        return redirect()->action('GroupController@show',$request->input('group_id'))
                         ->with('success','L\'utilsateur '.$user->email.' a été ajouté avec succès');
    }
}
