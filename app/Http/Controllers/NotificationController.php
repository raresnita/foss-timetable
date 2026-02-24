<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\User;
use App\Notifications\CourseUpdate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class NotificationController extends Controller
{
    public function send(Request $request)
    {
        $request->validate([
            'group_id' => 'required|exists:groups,id',
            'message' => 'required|string|max:500',
        ]);

        $group = Group::findOrFail($request->group_id);
        $professor = Auth::user(); // Assuming the logged-in user is the professor

// 1. Get all students in that group
// Adjust 'students' to whatever your relationship name is in the Group model
        $students = $group->students;

// 2. Send the notification to the collection of students
        Notification::send($students, new CourseUpdate(
            $professor,
            $request->message,
            $group
        ));

        return back()->with('success', 'Notification sent to ' . $group->name);
    }
}
