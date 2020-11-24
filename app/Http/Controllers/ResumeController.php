<?php

namespace App\Http\Controllers;

use App\Resume;

use Illuminate\Http\Request;

class ResumeController extends Controller
{

    public function index(Request $request){
        return  Resume::create($request->all());
     }

     public function getData() {
         return Resume::orderBy('id', 'desc')->get();
     }
    


    public function editResume(Request $request, $id){
        return  Resume::where('id', $id)->update([
            'id'=>$request->id,
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

     public function show($id) {
         $resume = Resume::findOrFail($id);

        //  return Resume::findOrFail($id)->experiences;
        //   return Resume::findOrFail($id)->with('experiences');

          return $resume->load("experiences",'educations',"skills","summaries");
     }

     public function deleteResume(Request $request, $id) {
            $fileName = $request->profile_img;
            $filePath = public_path().'/uploads/'.$fileName;
            if(file_exists($filePath)) {
                @unlink($filePath);
            };
        return Resume::where('id', $id)->delete();
     }

     public function upload(Request $request) {
             $pickName = time().'.'.$request->file->extension();
             $request->file->move(public_path('uploads'), $pickName );
             return $pickName;

    }

    public function deleteImg(Request $request) {
        $fileName = $request->profile_img;
        $filePath = public_path().'/uploads/'.$fileName;
        if(file_exists($filePath)) {
            @unlink($filePath);
        };
        return "done";
    }
    
}
