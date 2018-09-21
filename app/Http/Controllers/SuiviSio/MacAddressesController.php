<?php

namespace App\Http\Controllers\SuiviSio;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Group;
use App\Models\MacAddress;
use App\Http\Controllers\Controller;
use Auth;
use Excel;
use App\Http\Requests\MacAddressRequest;

class MacAddressesController extends Controller
{
    public function index()
    {
      $user = Auth::user();
      if ($user->can('view', MacAddress::class))
      {
          $addresses = $user->macAddresses;
          return view('macAddresses.index', compact('user', 'addresses'));
      }
      else
          return redirect()->back();
    }

    public function show($id)
    {
        $group = Group::findOrFail($id);
        if (Auth::user()->can('viewMacAddresses', $group))
        {
          $users = $group->getUsers();
          return view('macAddresses.show', compact('group', 'users'));
        }
        else
          return redirect()->back();
    }

    public function create()
    {
      $user = Auth::user();
      if($user->can('create', MacAddress::class))
          return view('macAddresses.edit', compact('user'));
      else
          return redirect()->back();
    }

    public function store(MacAddressRequest $request)
    {
      $user = Auth::user();
      if(Auth::user()->can('create', MacAddress::class))
      {
        $macAddress = new MacAddress();
        $macAddress->address = $request->input('address');
        $user->macAddresses()->save($macAddress);
        return redirect('macAddress')
                         ->with('success','Votre adresse MAC a été ajoutée.');
      }
      else
        return redirect()->back();
    }

    public function edit($id)
    {
      $user = Auth::user();
      $address = MacAddress::findOrFail($id);
      if ($user->can('edit', $address))
        return view('macAddresses.edit', compact('user', 'address'));
      else
        return redirect()->back();
    }

    public function update(MacAddressRequest $request, $id)
    {
      $user = Auth::user();
      $macAddress = MacAddress::findOrFail($id);
      if ($user->can('edit', $macAddress))
      {
        $macAddress->address = $request->input('address');
        $macAddress->save();
        return redirect('macAddress')
                         ->with('success','Votre adresse MAC a été mise à jour.');
      }
      else
        return redirect()->back();
    }

    public function destroy(Request $request, $id)
    {
      $user = Auth::user();
      $macAddress = MacAddress::findOrFail($id);
      if ($user->can('destroy', $macAddress))
      {
        $macAddress->delete();
        return redirect()->back()
                         ->with('success','Cette adresse MAC a bien été supprimée.');
      }
      else
        return redirect()->back();
    }
}
