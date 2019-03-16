<?php

namespace App\Http\Controllers\SuiviSio;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Group;
use App\Models\Document;
use Auth;

class DocumentController extends Controller
{
  public function show($classid, $documentid)
  {
    $group = Group::findOrFail($classid);
    $document = $group->documents()->where('id', $documentid)->first();
    if (Auth::user()->can('view', $document))
      return view('documents.show', compact('group', 'document'));
    else
      return redirect()->back();
  }

  public function edit(Request $request, $id)
  {
    $user = $request->user();
    $document = $user->documents()->where('id', $id)->first();
    if ($document == null)
      $document = $user->group->documents()->where('id', $id)->first();
    if ($user->can('view', $document))
      return view('documents.edit', compact('user', 'document'));
    else
      return redirect()->back();
  }

  public function update(Request $request, $id)
  {
    $user = $request->user();
    $document = Document::find($id);
    if ($user->can('edit', $document))
    {
      $this->validate($request, ['file_name' => 'required|mimes:pdf|max:10000']);
      $old_document = $user->documents()->where('id', $id)->first();
      if ($old_document != null)
        $user->documents()->detach($old_document);
      $user->documents()->attach($document,
        ['file_name' => $request->file('file_name')->store('public')]);
      return redirect()->back()->with('success', 'Modifications enregistrées');
    }
    else
      return redirect()->back();
  }
}
