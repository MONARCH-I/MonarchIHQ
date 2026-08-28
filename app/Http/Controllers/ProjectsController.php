<?php

namespace App\Http\Controllers;

use App\Models\PortfolioProject;

class ProjectsController extends Controller
{
    public function index()
    {
        $projects = PortfolioProject::published()->get();
        return view('pages.projects', compact('projects'));
    }
}
