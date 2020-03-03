<?php

namespace App\Http\Controllers\Classroom;

use MomentPHP\MomentPHP;
use App\Models\Classroom;
use App\Models\Classwork;
use App\Models\ClassModel;
use Illuminate\Http\Request;
use InvalidArgumentException;
use App\Models\JoinClassRequest;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;

class ClassroomController extends Controller
{

    public function class($id)
    {
        $class = ClassModel::find($id);
        if ($class) {
            if ($class->owner_id == Auth::user()->id) {
                return self::viewClass($class);
            }
            $user = Auth::user();
            foreach ($user->classrooms as $classroom) {
                if ($classroom->id == $id) {
                    return self::viewClass($class);
                }
            }
            return view('errs.404');
        } else {
            return view('errs.404');
        }
    }

    private function viewClass($class)
    {
        return view('classroom.classwork', [
            'class' => $class,
            'classworks' => $class->classworks,
            'class_id' => ''.$class->id,
            'class_name' => ''.$class->class_name,
            'class_subject' => ''.$class->class_subject,
            'class_description' => ''.$class->class_description,
            'class_image' => ''.$class->class_image,
            'referral_code' => ''.$class->referral_code,
            'owner_id' => ''.$class->owner_id,
        ]);
    }
    
    public function createClass(Request $request) 
    {
        $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $referralCode = substr(str_shuffle($permitted_chars), 0, 6);
        $ownerId = Auth::user()->id;

        $class = new ClassModel();
        $class->class_name = ''.$request->className;
        $class->class_subject = ''.$request->classSubject;
        $class->class_description = ''.$request->classDesc;
        $class->referral_code = ''.$referralCode;
        $class->owner_id = ''.$ownerId;


        try {
            $class->save();
        } catch (QueryException $e) {
            $errorCode = $e->errorInfo[1];
            if($errorCode == 1062){
                $againReferralCode = substr(str_shuffle($permitted_chars), 0, 6);
                $class->referral_code = ''.$againReferralCode;
                $class->save();
            }
        }
        $class->classworks = [];
        return redirect()->to('/home');
    }

    public function joinClass(Request $request) 
    {
        $class = ClassModel::where('referral_code', $request->code)->first();
        $yourId = Auth::user()->id;
        if ($class) {
            if ($yourId != $class->owner_id) {
                $classroom = new JoinClassRequest();
                $classroom->user_id = $yourId;
                $classroom->class_id = $class->id;
                $classroom->description = $request->description;
                $classroom->owner_id = $class->owner_id;
                try {
                    $classroom->save();
                } catch (QueryException $e) {
                    $errorCode = $e->errorInfo[1];
                    if($errorCode == 1062) {
                        
                    }
                }
            } else {
                // TODO: if it's your own class, you cannot join
            }
            $classworks = Classwork::where('class_id', $class->id)->get();
            $classworkss = [];
            foreach($classworks as $classwork) {
                self::formatDateTime($classwork);
                $classworkss[] = $classwork;
            }
            $class->classworks = $classworkss;
            return redirect()->to('/home');
        } else {
            return redirect()->to('/home');
        }
    }

    public function confirmStudents($studentId, $classId)
    {   
        DB::table('join_class_request')->where('user_id', $studentId)->where('class_id', $classId)->delete();

        $classroom = new Classroom();
        $classroom->user_id = $studentId;
        $classroom->class_id = $classId;
        $classroom->save();

        return redirect()->to('/home');
    }

    public function rejectStudents($studentId, $classId)
    {
        DB::table('join_class_request')->where('user_id', $studentId)->where('class_id', $classId)->delete();
        return redirect()->to('/home');
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

    public function deleteClass($classId) 
    {
        $class = ClassModel::find($classId);
        if ($class->owner_id == Auth::user()->id) {
            $class->delete();
            return redirect('/');
        } else {
            return view('errs.404');
        }
    }

    public function updateClass($classId, Request $request) 
    {
        $class = ClassModel::find($classId);
        if ($class->owner_id == Auth::user()->id) {
            $class->class_name = $request->className;
            $class->class_subject = $request->classSubject;
            $class->class_description = $request->classDesc;
            $class->save();
        } else {
            return view('errs.404');
        }
    }

    public function leaveClass($classId) 
    {
        $class = Classroom::where('class_id', $classId)->first();
        if ($class->user_id == Auth::user()->id) {
            Classroom::where('class_id', $classId)->delete();
            return redirect('/');
        } else {
            return view('errs.404');
        }
    }

}
