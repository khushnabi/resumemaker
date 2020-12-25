<?php

namespace App\Http\Controllers;


use App\Resume;
use App\Education;

use Illuminate\Http\Request;

class EducationController extends Controller
{

    public function index(Resume $resume) {
       return $resume->educations;
    }
   

   public function store(Request $request,Resume $resume) {
        return $resume->educations()->create($request->all());
    }


     public function show(Resume $resume, $id) {
        return $resume->educations()->findOrFail($id);
    }


    public function update(Request $request,Resume $resume, $id) {

        return $resume->educations()->findOrFail($id)->update($request->all());

    }

    public function destroy(Resume $resume, $id) {
        return $resume->educations()->findOrFail($id)->delete();
    }

   
}
