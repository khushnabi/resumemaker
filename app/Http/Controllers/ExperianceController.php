<?php

namespace App\Http\Controllers;

use App\Resume;
use App\Experience;

use Illuminate\Http\Request;

class ExperianceController extends Controller
{
    // public function index($resume_id) {
    //     $resume = Resume::findById($resume_id);
    //     if (!$resume) {
    //         return abort(404);
    //     }
    //     return $resume->experiences;
    // }


    public function store(Request $request,Resume $resume) {
        return $resume->experiences()->create($request->all());
    }
}
