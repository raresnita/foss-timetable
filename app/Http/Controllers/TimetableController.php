<?php

namespace App\Http\Controllers;

use App\Models\Group;
//use App\Models\Professor;
use App\Models\Timetable;
use App\Models\User;

class TimetableController extends Controller
{
    //
    public function groupTimetable(Group $group){
//        dd($group);
        $timetable = Timetable::with(['subject.professor', 'classroom'])
            ->where('group_id', $group->id)
            ->orderBy('day_of_week')
            ->orderBy('start_time')
            ->get()
            ->groupBy('day_of_week');

        return view('groups.timetable', compact('group', 'timetable'));
    }

    public function professorTimetable(User $professor)
    {
//        dd($professor);
        if($professor->user_role !== 'prof'){
            abort(404);
        }

        $timetable = Timetable::with(['subject.group', 'classroom'])
            ->whereHas('subject', function ($query) use ($professor) {
                $query->where('professor_id', $professor->id);
            })
            ->orderBy('day_of_week')
            ->orderBy('start_time')
            ->get()
            ->groupBy('day_of_week');

        return view('professors.timetable', compact('professor', 'timetable'));
    }
}
