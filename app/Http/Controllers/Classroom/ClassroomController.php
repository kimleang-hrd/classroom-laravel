<?php

namespace App\Http\Controllers\Classroom;

use App\Models\Classroom;
use App\Models\ClassModel;
use Illuminate\Http\Request;
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
            return view('classroom.class', [
                'class_name' => ''.$class->class_name,
                'class_subject' => ''.$class->class_subject,
                'class_description' => ''.$class->class_description,
                'class_image' => ''.$class->class_image,
                'referral_code' => ''.$class->referral_code,
                'owner_id' => ''.$class->owner_id,
            ]);
        } else {
            return view('classroom.class');
        }
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
    }

    public function joinClass(Request $request) 
    {
        $class = ClassModel::where('referral_code', $request->code)->first();
        $yourId = Auth::user()->id;
        if ($class) {
            if ($yourId != $class->owner_id) {
                $classroom = new Classroom();
                $classroom->user_id = $yourId;
                $classroom->class_id = $class->id;
                try {
                    $classroom->save();
                } catch (QueryException $e) {
                    $errorCode = $e->errorInfo[1];
                    if($errorCode == 1062) {
                        
                    }
                }
            } else {

            }
        }
    }


}
