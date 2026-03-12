<?php
//
//namespace App\Http\Controllers;
//
//use App\Models\Classroom;
//use App\Models\Group;
//use App\Models\Timetable;
//use App\Models\User;
//
//class TimetableController extends Controller
//{
//    public function groupTimetable(Group $group){
//        return $this->renderTimetable($group, 'group', ['subject.professor', 'classroom']);
//    }
//
//    public function professorTimetable(User $professor) {
//        if($professor->user_role !== 'prof') abort(404);
//
//        return $this->renderTimetable($professor, 'professor', ['subject', 'group', 'classroom']);
//    }
//
//    public function classroomTimetable(Classroom $classroom) {
//        return $this->renderTimetable($classroom, 'classroom', ['subject.professor', 'group']);
//    }
//
//    private function renderTimetable($model, $context, $relations)
//    {
//        $timetable = Timetable::with($relations)
//            ->when($context === 'group', fn($q) => $q->where('group_id', $model->id))
//            ->when($context === 'classroom', fn($q) => $q->where('classroom_id', $model->id))
//            ->when($context === 'professor', fn($q) => $q->whereHas('subject', fn($sq) => $sq->where('professor_id', $model->id)))
//            ->orderBy('day_of_week')
//            ->orderBy('start_hour')
//            ->get()
//            ->groupBy('day_of_week');
//
//        return view('timetable', [
//            'owner' => $model,
//            'timetable' => $timetable,
//            'context' => $context
//        ]);
//    }
//}



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
