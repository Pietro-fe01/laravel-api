<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Technology;
use App\Models\Type;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::all();

        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = Type::all(); // Get all types
        $technologies = Technology::all(); // Get all technologies

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
        $data = $request->validated();

        $new_project = new Project();
            $new_project->fill($data);

            if ( isset($data['cover_image']) ) {
                $img_path = Storage::disk('public')->put('uploads', $data['cover_image']);
                $new_project->cover_image = $img_path;
            };

            $new_project->slug = Str::slug($new_project->project_title);

        $new_project->save();

        // Save records into pivot table
        if( isset($data['technologies']) ) {
            $new_project->technologies()->sync($data['technologies']);
        }

        return redirect()->route('admin.projects.show', $new_project);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
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
        $types = Type::all(); // Get all types
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
        $data = $request->validated();

        if ( isset($data['cover_image']) ) {
            // Removing old img in DB before adding new
            if ( $project->cover_image ) {
                Storage::disk('public')->delete($project->cover_image);
            }
            $img_path = Storage::disk('public')->put('uploads', $data['cover_image']);
            $project->cover_image = $img_path;
        };

        $project->slug = Str::slug($data['project_title']);

        if ( isset( $data['remove_image'] ) && $project->cover_image ) {
            Storage::disk('public')->delete($project->cover_image);
            $project->cover_image = null;
        }

        $project->update($data);

        if( isset($data['technologies']) ) {
            // Save records into pivot table if $data['technologies] is isset
            $project->technologies()->sync($data['technologies']);
        } else {
            // Else every record to its project is cancelled
            $project->technologies()->sync([]);
        }

        return redirect()->route('admin.projects.show', $project);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $id = $project->id;

        if ( $project->cover_image ) {
            Storage::disk('public')->delete($project->cover_image);
        }

        $project->delete();

        return redirect()->route('admin.projects.index')->with('message', "Il progetto con ID numero $id è stato cancellato con successo.");
    }
}
