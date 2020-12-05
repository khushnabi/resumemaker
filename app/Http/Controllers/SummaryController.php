<?php

namespace App\Http\Controllers;

use App\Resume;
use App\Summary;

use Illuminate\Http\Request;

class SummaryController extends Controller
{
    public function store(Request $request,Resume $resume) {
        return $resume->summaries()->create($request->all());
    }
}
