<?php

namespace App\Http\Controllers\Classroom;

use MomentPHP\MomentPHP;
use App\Models\Classwork;
use App\Models\ClassModel;
use Illuminate\Http\Request;
use InvalidArgumentException;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;

class ClassworkController extends Controller
{
    
    public function index($classId) 
    {
        $class = ClassModel::find($classId);
        $classworks = Classwork::where('class_id', $classId)->where('parent_id', null)->get();
        $classworkss = [];
        foreach($classworks as $classwork) {
            self::formatDateTime($classwork);
            $studentWorks = Classwork::where('class_id', $classId)->where('parent_id', $classwork->id)->get();
            foreach($studentWorks as $work) {
                $work->worker = User::find($work->user_id);
            }
            $classwork->student_works = $studentWorks;
            $classworkss[] = $classwork;
        }
        $class->classworks = $classworkss;
        return self::viewClass($class);
    }

    private function formatDateTime($classwork)
    {
        try {
            $moment = new MomentPHP($classwork->created_at, 'Y-m-d H:i:s');
            $classwork->createdAt = $moment->fromNow();
        } catch (InvalidArgumentException $ex) {
            $classwork->createdAt = "មិនច្បាស់";
        }
    }

    private function viewClass($class)
    {
        return view('classroom/classwork', [
            'class_id' => ''.$class->id,
            'class' => $class,
            'classworks' => $class->classworks
        ]);
    }

    public function create(Request $request) 
    {
        $class = ClassModel::find($request->class_id);
        $classwork = new Classwork();
        $classwork->title = ''.$request->title;
        $classwork->description = ''.$request->description;
        $classwork->link = ''.$request->link;
        if ($request->file) {
            $file = $request->file->storeAs('classworks', $request->file->getClientOriginalName());
            $classwork->file = ''.$request->file->getClientOriginalName();
        }
        $classwork->class_id = $request->class_id;
        $classwork->user_id = Auth::user()->id;

        try {
            $classwork->save();
        } catch (QueryException $e) {
            $errorCode = $e->errorInfo[1];
            if($errorCode == 1062) {
             
            }
        }

        return redirect()->to('classwork/'.$request->class_id);
    }

    public function submit(Request $request) 
    {
        $class = ClassModel::find($request->class_id);
        $classwork = new Classwork();
        $classwork->title = ''.$request->title;
        $classwork->description = ''.$request->description;
        $classwork->link = ''.$request->link;
        if ($request->file) {
            $file = $request->file->storeAs('classworks', $request->file->getClientOriginalName());
            $classwork->file = ''.$request->file->getClientOriginalName();
        }
        $classwork->class_id = $request->class_id;
        $classwork->parent_id = $request->classwork_id;
        $classwork->user_id = Auth::user()->id;

        try {
            $classwork->save();
        } catch (QueryException $e) {
            $errorCode = $e->errorInfo[1];
            if($errorCode == 1062) {
             
            }
        }

        return redirect()->to('classwork/'.$request->class_id);
    }

}
