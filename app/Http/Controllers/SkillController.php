<?php

namespace App\Http\Controllers;

use App\Skill;
use App\Resume;


use Illuminate\Http\Request;

class SkillController extends Controller
{

	public function index(Resume $resume) {
       return $resume->skills;
    }
    
   
    public function store(Request $request,Resume $resume) {
        return $resume->skills()->create($request->all());
    }



     public function show(Resume $resume, $id) {
        return $resume->skills()->findOrFail($id);
    }


    public function update(Request $request,Resume $resume, $id) {

        return $resume->skills()->findOrFail($id)->update($request->all());

    }

    public function destroy(Resume $resume, $id) {
        return $resume->skills()->findOrFail($id)->delete();
    }
}
