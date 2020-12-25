<?php

namespace App\Http\Controllers;

use App\Resume;
use App\Summary;

use Illuminate\Http\Request;

class SummaryController extends Controller
{
    

    public function index(Resume $resume) {
       return $resume->summaries;
    }
    
   public function store(Request $request,Resume $resume) {
        return $resume->summaries()->create($request->all());
    }

     public function show(Resume $resume, $id) {
        return $resume->summaries()->findOrFail($id);
    }


    public function update(Request $request,Resume $resume, $id) {

        return $resume->summaries()->findOrFail($id)->update($request->all());

    }

    public function destroy(Resume $resume, $id) {
        return $resume->summaries()->findOrFail($id)->delete();
    }
}
