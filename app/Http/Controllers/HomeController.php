<?php

namespace App\Http\Controllers;

use App\User;
use MomentPHP\MomentPHP;
use App\Models\Classroom;
use App\Models\ClassModel;
use Illuminate\Http\Request;
use InvalidArgumentException;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();
        $classrooms = [];
        // Class you have joint
        foreach ($user->classrooms as $classroom) {
            $classroom->count = Classroom::where('class_id', $classroom->id)->count();
            self::formatDateTime($classroom);
            $ownerImage = User::find($classroom->owner_id)->first()->image;
            $classroom->ownerImage = $ownerImage;
            $classrooms[] = $classroom;
        }

        $classes = ClassModel::where('owner_id', $user->id)->get();
        foreach ($classes as $classroom) {
            $classroom->count = Classroom::where('class_id', $classroom->id)->count();
            self::formatDateTime($classroom);
            $classroom->ownerImage = Auth::user()->image;
            $classrooms[] = $classroom;
        }
        return view('home', ['classrooms' => $classrooms]);
    }

    private function formatDateTime($classroom)
    {
        try {
            $moment = new MomentPHP(''.$classroom->created_at, 'Y-m-d H:i:s');
            $classroom->createdAt = $moment->fromNow();
        } catch (InvalidArgumentException $ex) {
            $classroom->createdAt = "មិនច្បាស់";
        }
    }
    
}
