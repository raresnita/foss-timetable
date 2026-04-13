<?php


namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\Group;
use App\Models\User;
use App\Services\TimetableService;

class TimetableController extends Controller
{
    protected TimetableService $timetableService;

    public function __construct(TimetableService $service)
    {
        $this->timetableService = $service;
    }

    public function groupTimetable(Group $group)
    {
        return $this->renderView($group, 'group');
    }

    public function classroomTimetable(Classroom $classroom)
    {
        return $this->renderView($classroom, 'classroom');
    }

    public function professorTimetable(User $professor)
    {
        if ($professor->user_role !== 'prof') abort(404);
        return $this->renderView($professor, 'professor');
    }

    private function renderView($model, $context)
    {
        // Ask the service for the data
        $timetable = $this->timetableService->getTimetableData($model, $context)
            ->groupBy('day_of_week');

        return view('timetable', [
            'owner' => $model,
            'timetable' => $timetable,
            'context' => $context
        ]);
    }
}
