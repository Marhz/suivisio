<?php

namespace App\Http\Controllers\SuiviSio;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Group;
use App\Models\MacAddress;
use App\Http\Controllers\Controller;
use Auth;
use Excel;
use App\Http\Requests\UserRequest;

class MacAddressesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        dd('index-macaddress');
        //return redirect('/');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      dd('create-macaddress');
      //return redirect('/');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $user = Auth::user();
      if (config('app.collect_mac_addresses') && $user->can('editMacAddress', $user))
      {
        $this->validate($request,
          ['address' => 'required|regex:/([0-9A-Fa-f]{2}[:]){5}([0-9A-Fa-f]{2})$/'],
          ['address.regex' => 'L\'adresse doit être composée de 6 blocs de deux chiffres hexadécimaux séparés par des ":".']
          );
        $macAddress = $user->macAddresses->first();
        if($macAddress == null)
          $macAddress = new MacAddress();
        $macAddress->address = $request->input('address');
        $user->macAddresses()->save($macAddress);
        return redirect()->back()
                         ->with('success','Votre adresse MAC a été enregistrée.');
      }
      else
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $group = Group::findOrFail($id);
        if (config('app.collect_mac_addresses') && Auth::user()->can('viewMacAddresses', $group))
        {
          \Illuminate\Support\Collection::macro('concat', function ($source) {
              $result = new static($this);

              foreach ($source as $item) {
                  $result->push($item);
              }

              return $result;
          });
          $users = $group->users->concat($group->teachers);
          return view('macAddresses.show', compact('users'));
        }
        else
          return redirect()->back();
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
      if (config('app.collect_mac_addresses') && $user->can('editMacAddress', $user))
      {
          $addresses = $user->macAddresses;
          $address = null;
          if ($addresses->first() != null)
            $address = $user->macAddresses->first()->address;
          return view('macAddresses.edit', compact('user', 'address'));
      }
      return redirect()->back();
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
      dd('update-macaddress');
      //return redirect('/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserRequest $request,$id)
    {
      dd('destroy-macaddress');
      //return redirect('/');
    }
}
