<?php

namespace App\Http\Controllers\SuiviSio;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::with('course')->orderBy('nomenclature')->get();
        return view('categories.list',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $activities = \App\Activity::all();
        $activities = $this->prepareForSelect($activities);
        return view('categories.create-edit',compact('activities'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this->prepareData($request->except('activity_list'));
        $category = Category::create($data);
        $category->activities()->sync($request->input('activity_list'));
        return redirect()->route('categories.index')->with('success', 'Catégorie crée avec succès');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::find($id);
        $activities = \App\Activity::all();
        $activities = $this->prepareForSelect($activities);
        return view('categories.create-edit',compact('category','activities'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $this->prepareData($request->except('activity_list'));
        $category = Category::find($id);
        $category->update($data);
        $category->activities()->sync($request->input('activity_list'));

        return redirect()->route('categories.index')->with('success', 'Catégorie mise à jour avec succès');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        $category->activities()->sync([]);
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Catégorie effacée avec succès');

    }
    protected function prepareForSelect($activities)
    {
        foreach($activities as $activity)
            $activity->nomenclature = $activity->fullName();
        $activities = $activities->pluck('nomenclature', 'id');
        return $activities;
    }
    protected function prepareData($data)
    {
        if($data['course_id'] == 0)
            $data['course_id'] = null;
        return $data;
    }
}
