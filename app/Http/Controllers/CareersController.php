<?php

namespace App\Http\Controllers;

use App\Models\JobListing;

class CareersController extends Controller
{
    public function index()
    {
        $jobs = JobListing::active()->get();

        return view('pages.careers', compact('jobs'));
    }
}
