<?php

namespace App\Http\Controllers;

use App\Resume;
use App\Experience;

use Illuminate\Http\Request;

class ExperienceController extends Controller
{
    public function index(Resume $resume) {
       return $resume->experiences;
    }
   

    public function store(Request $request,Resume $resume) {
        return $resume->experiences()->create($request->all());
    }


     public function show(Resume $resume, $id) {
        return $resume->experiences()->findOrFail($id);
    }


    public function update(Request $request,Resume $resume, $id) {

        return $resume->experiences()->findOrFail($id)->update($request->all());

    }

    public function destroy(Resume $resume, $id) {
        return $resume->experiences()->findOrFail($id)->delete();
    }
}
