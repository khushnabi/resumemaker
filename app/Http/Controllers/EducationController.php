<?php

namespace App\Http\Controllers;


use App\Resume;
use App\Education;

use Illuminate\Http\Request;

class EducationController extends Controller
{
    public function store(Request $request,Resume $resume) {
        return $resume->educations()->create($request->all());
    }
}
