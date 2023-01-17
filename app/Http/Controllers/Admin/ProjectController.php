<?php

namespace App\Http\Controllers\Admin; //ho spostato il controller

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Type;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Technology;

use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::orderByDesc('id')->get();
        $technologies = Technology::all();
        //dd($projects);
        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = Type::all();
        $technologies = Technology::all();
        //dd($types);
        return view('admin.projects.create', compact('types', 'technologies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProjectRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProjectRequest $request)
    {
        //dd($request->all());
        $validated_data = $request->validated();

        //se viene aggiunta dall'utente, inserisco il valore img in una variabile
        if ($request->hasFile('cover_img')) {
            $cover_img = Storage::put('uploads', $validated_data['cover_img']);

            //sostituisco il valore di cover_img nei dati validati
            $validated_data['cover_img'] = $cover_img;
        }


        //project slug
        $project_slug = Project::createSlug($validated_data['title']);

        $validated_data['slug'] = $project_slug;

        $project = Project::create($validated_data);

        if ($request->has('technologies')) {
            $project->technologies()->attach($validated_data['technologies']);
        }

        return to_route('admin.projects.index')->with('message', 'New Project added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        //dd($project->type);
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {

        $types = Type::all();
        $technologies = Technology::all();
        return view('admin.projects.edit', compact('project', 'types', 'technologies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProjectRequest  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        $validated_data = $request->validated();

        if ($request->hasFile('cover_img')) {
            //se il post ha già un'immagine, la cancello, per poi inserirne un altra
            if ($project->cover_img) {
                Storage::delete($project->cover_img);
            }
            $cover_img = Storage::put('uploads', $validated_data['cover_img']);

            //sostituisco il valore di cover_img nei dati validati
            $validated_data['cover_img'] = $cover_img;
        }

        //project slug
        $project_slug = Project::createSlug($validated_data['title']);

        $validated_data['slug'] = $project_slug;
        $project->update($validated_data);

        //tramite questa condizione sicronizzo le tecnologie aggiunte se presenti
        if ($request->has('technologies')) {
            $project->technologies()->sync($validated_data['technologies']);
        } else {
            $project->technologies()->sync([]);
        }

        return to_route('admin.projects.index')->with('message', " Project $project->title modified");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {

        //se esiste un'immagine, cancellala
        if ($project->cover_img) {
            Storage::delete($project->cover_img);
        }

        $project->delete();
        return to_route('admin.projects.index')->with('message', " Project $project->title deleted");
    }
}
