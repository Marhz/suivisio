<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \PDF;
use App\Http\Requests\PasswordRequest;

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
        if(\Auth::user()->level == 2)
            return view('home.student');
        return view('home.teacher');
    }
    public function admin()
    {
        return view('home.admin');
    }
    public function editPassword()
    {
        return view('edit-password');
    }
    public function updatePassword(PasswordRequest $request)
    {
      $user = \Auth::user();
        if (!$user->passwordConfirmed)
        //if(password_verify($request->input('old_password'), \Auth::user()->password)){
        {
            $user->password = bcrypt($request->input('password'));
            $user->passwordChanged = true;
            $user->save();
            return redirect('/')->with('success', 'Mot de passe changé avec succès');
        }
        return redirect()->back()->with('error', 'Le mot de passe a déjà été changé');
    }
}
