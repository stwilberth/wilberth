<?php

namespace App\Http\Controllers;

use App\Models\Project;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::all();
        $seller = (object) [
            'name' => 'Wilberth',
            'whatsapp' => '+506 85008393',
        ];
        $title = 'Proyectos - Wilberth';

        return view('projects.index', compact('projects', 'seller', 'title'));
    }

    public function show(string $slug)
    {
        $project = Project::where('slug', $slug)->firstOrFail();
        $seller = (object) [
            'name' => 'Wilberth',
            'whatsapp' => '+506 85008393',
        ];
        $title = "{$project->name} - Wilberth";

        return view('projects.show', compact('project', 'seller', 'title'));
    }
}
