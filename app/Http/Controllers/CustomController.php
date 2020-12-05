<?php

namespace App\Http\Controllers;

use App\Resume;
use App\Custom;
use Illuminate\Http\Request;

class CustomController extends Controller
{
    public function store(Request $request,Resume $resume) {
        return $resume->customs()->create($request->all());
    }
}
