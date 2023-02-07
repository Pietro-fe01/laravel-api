<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index() { 
        // Return all projects and relative dipendences
        return Project::with('type', 'technologies')->get();
    }

    public function show($slug) { 
        try {
            return Project::where('slug', $slug)->with('type', 'technologies', 'reviews')->firstOrFail();
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response([
                'error' => '404 | Project not found'
            ], 404);
        }
    }

    public function filterByType($type_id) {
        return Project::where('type_id', $type_id)->with('type', 'technologies')->get();
    }
}
