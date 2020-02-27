<?php

namespace App\Http\Controllers\Classroom;

use App\Models\Classwork;
use App\Models\ClassModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ClassworkController extends Controller
{
    
    public function index($classId) 
    {
        $class = ClassModel::find($classId);
        return self::viewClass($class);
    }

    private function viewClass($class)
    {
        return view('classroom/classwork', [
            'class_id' => ''.$class->id
        ]);
    }

    public function create(Request $request) 
    {
        $class = ClassModel::find($request->class_id);
        if ($request->file) {
            $file = $request->file->storeAs('classworks', $request->file->getClientOriginalName());
        }
        $classwork = new Classwork();
        $classwork->title = ''.$request->title;
        $classwork->description = ''.$request->description;
        $classwork->link = ''.$request->link;
        $classwork->file = ''.$request->file->getClientOriginalName();
        $classwork->class_id = $request->class_id;
        $classwork->user_id = Auth::user()->id;
        try {
            $classwork->save();
        } catch (QueryException $e) {
            $errorCode = $e->errorInfo[1];
            if($errorCode == 1062) {
             
            }
        }
        return self::viewClass($class);
    }

}
