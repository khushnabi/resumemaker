<?php

namespace App\Http\Controllers;

use App\Skill;
use App\Resume;


use Illuminate\Http\Request;

class SkillController extends Controller
{
    public function store(Request $request,Resume $resume) {
        return $resume->skills()->create($request->all());
    }
}
