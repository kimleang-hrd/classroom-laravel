<?php

namespace App\Http\Controllers;

use App\User;
use App\Models\Classroom;
use App\Models\ClassModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PeopleController extends Controller
{
    
    public function index($classId)
    {
        $class = ClassModel::find($classId);
        $owner = User::find($class->owner_id);
        // $classroom = Classroom::where('class_id', $classId)->first();
        $students = [];
        foreach ($class->users as $student) {
            $students[] = $student;
        }
        return self::viewClass($class, $owner, $students);
    }

    private function viewClass($class, $owner, $students)
    {
        return view('classroom/students-list', [
            'class_id' => ''.$class->id,
            'referral_code' => ''.$class->referral_code,
            'owner' => $owner,
            'students' => $students
        ]);
    }

}
