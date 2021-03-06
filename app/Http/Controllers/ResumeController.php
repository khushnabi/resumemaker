<?php

namespace App\Http\Controllers;

use App\Resume;

use Illuminate\Http\Request;

class ResumeController extends Controller
{

    public function index(Request $request)
    {
        $user = $request->user();
        return $user->resumes()->with("experiences", 'educations', "skills", "summaries", "customs")->get();
    }

    public function store(Request $request)
    {
        $user = $request->user();
        @list($firstName, $lastName) = explode(' ', $user->name);
        return Resume::create([
            'user_id' => $user->id,
            'first_name' => $firstName,
            'last_name' => $lastName,
        ]);
    }

    public function show(Request $request, Resume $resume)
    {
        if (!$request->user()->can('show', $resume)) {
            abort(404);
        }
        return $resume->load("experiences", 'educations', "skills", "summaries", "customs");
    }

    public function update(Request $request, Resume $resume)
    {
        if (!$request->user()->can('update', $resume)) {
            abort(404);
        }
        return $resume->update([
            'id' => $request->id,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'address' => $request->address,
            'city' => $request->city,
            'postal_code' => $request->postal_code,
            'phone' => $request->phone,
            'email' => $request->email,
            'profile_img' => $request->profile_img,
        ]);
    }

    public function destroy(Request $request, Resume $resume)
    {
        if (!$request->user()->can('delete', $resume)) {
            abort(404);
        }
        $fileName = $resume->profile_img;
        $filePath = public_path() . '/uploads/' . $fileName;
        if (file_exists($filePath)) {
            @unlink($filePath);
        };
        return $resume->delete();
    }

    public function upload(Request $request)
    {
        $pickName = time() . '.' . $request->file->extension();
        $request->file->move(public_path('uploads'), $pickName);
        return $pickName;
    }

    public function deleteImg(Request $request)
    {
        $fileName = $request->profile_img;
        $filePath = public_path() . '/uploads/' . $fileName;
        if (file_exists($filePath)) {
            @unlink($filePath);
        };
        return "done";
    }
}
