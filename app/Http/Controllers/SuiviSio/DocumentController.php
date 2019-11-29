<?php

namespace App\Http\Controllers\SuiviSio;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Group;
use App\Models\Document;
use Auth;
use User;
use Exception;

use App\Events\Document\DocumentUploadsEvent;
use App\Events\Document\TeacherAcceptsEvent;
use App\Events\Document\TeacherRejectsEvent;

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

  public function editStudent(Request $request, $id)
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

  public function editTeacher(Request $request, $userid, $documentid)
  {
    $user = User::findorfail($userid);
    $document = $user->documents()->where('id', $documentid)->first();
    if (Auth::user()->can('accept', $document))
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
      $this->validate($request, ['file_name' => 'required|mimes:pdf|max:3000']);
      $old_document = $user->documents()->where('id', $id)->first();
      if ($old_document != null)
        $user->documents()->detach($old_document);
      $file_name = $request->file('file_name')->store('public');
      $this->checkFormat($file_name);
      $user->documents()->attach($document,
        ['file_name' => $file_name]);
      event(new DocumentUploadsEvent($user, $document));
      return redirect()->back()->with('success', 'Modifications enregistrées');
    }
    else
      return redirect()->back();
  }

  public function accept(Request $request, $userid, $documentid)
  {
    $user = User::findorfail($userid);
    if (Auth::user()->can('accept', Document::class))
    {
      $user->documents()->updateExistingPivot($documentid, ['validated' => 1]);
      event(new TeacherAcceptsEvent($user, Document::find($documentid)));
      return redirect()->back()->with('success', 'Document validé');
    }
    else
      return redirect()->back();
  }

  public function reject(Request $request, $userid, $documentid)
  {
    $user = User::findorfail($userid);
    if (Auth::user()->can('accept', Document::class))
    {
      $user->documents()->updateExistingPivot($documentid, ['validated' => 0, 'comment' => $request->input('comment')]);
      event(new TeacherRejectsEvent($user, Document::find($documentid), $request->input('comment')));
      return redirect()->back()->with('success', 'Document rejeté');
    }
    else
      return redirect()->back();
  }

  public function checkFormat($file_name)
  {
      $pdf = new \PDFMerger();
      $pdf->addPDF(storage_path('app') . '/' . $file_name, 'all');
      register_shutdown_function(function ()
        {
          dd('Ce pdf n\'est pas compatible avec l\'application (pdf version supérieure à 1.4). Tentez de le numériser avec un autre logiciel.');
        }
      );
      $pdf->merge('string', "mergedpdf.pdf");
  }

  public function concat(Request $request, $classid, $documentid)
  {
    $pdf = new \PDFMerger();
    $document = Document::findorfail($documentid);
    if (Auth::user()->can('view', $document))
    {
      $empty = true;
      foreach ($document->users()->where('group_id', $classid)->get() as $user)
        if ($user->pivot->file_name != null && $user->pivot->validated)
        {
          $pdf->addPDF(storage_path('app') . '/' . $user->pivot->file_name, 'all');
          $empty = false;
        }
      if (!$empty)
      {
        $binaryContent = $pdf->merge('string', "mergedpdf.pdf");
        return response($binaryContent)
            ->header('Content-type', 'application/pdf');
      }
    }
    return redirect()->back();
  }
}
