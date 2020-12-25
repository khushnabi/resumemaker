<?php

namespace App\Http\Controllers;

use App\Resume;
use App\Custom;
use Illuminate\Http\Request;

class CustomController extends Controller
{

	public function index(Resume $resume) {
       return $resume->customs;
    }
    
    public function store(Request $request,Resume $resume) {
        return $resume->customs()->create($request->all());
    }

     public function show(Resume $resume, $id) {
        return $resume->customs()->findOrFail($id);
    }


    public function update(Request $request,Resume $resume, $id) {

        return $resume->customs()->findOrFail($id)->update($request->all());

    }

    public function destroy(Resume $resume, $id) {
        return $resume->customs()->findOrFail($id)->delete();
    }
}
