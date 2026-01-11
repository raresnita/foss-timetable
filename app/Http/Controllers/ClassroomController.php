<?php


namespace App\Http\Controllers;

use App\Models\Classroom;
use Illuminate\Http\Request;

class ClassroomController extends Controller
{
    public function __invoke()
    {
        $classrooms = Classroom::all();
        return view('classrooms.index', compact('classrooms'));
    }
}

