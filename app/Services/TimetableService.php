<?php

namespace App\Services;

use App\Models\Timetable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class TimetableService
{
    public function getTimetableData($model, $context): Collection
    {
        $relations = match ($context) {
            'group' => ['subject.professor', 'classroom'],
            'professor' => ['subject', 'group', 'classroom'],
            'classroom' => ['subject.professor', 'group'],
        };

        return Timetable::with($relations)
            ->when($context === 'group', fn($q) => $q->where('group_id', $model->id))
            ->when($context === 'classroom', fn($q) => $q->where('classroom_id', $model->id))
            ->when($context === 'professor', fn($q) => $q->whereHas('subject', fn($sq) => $sq->where('professor_id', $model->id)))
            ->orderBy('day_of_week')
            ->orderBy('start_hour')
            ->get();
    }

    public function getCurrentCourse($user): ?Model
    {
        if (!$user) return null;

        $now = now('Europe/Bucharest');
        $currentDay = $now->dayOfWeekIso; // 1 (Mon) to 7 (Sun)

        $isProf = ($user->user_role === 'prof');
        $context = $isProf ? 'professor' : 'group';
        $model = $isProf ? $user : $user->group;

        if (!$model) return null;

        $courses = $this->getTimetableData($model, $context);
//        dd($courses);


        // Return the first course where current time is between start and end
        return $courses->first(function ($item) use ($now, $currentDay) {
            if ($item->day_of_week != $currentDay) return false;

            $start = Carbon::parse($item->start_hour, 'Europe/Bucharest')->setDateFrom($now);
            $end = Carbon::parse($item->end_hour, 'Europe/Bucharest')->setDateFrom($now);

            return $now->between($start, $end);
        });
    }

    public function getNextCourse($user): ?Model
    {
        if (!$user) return null;

        $now = now('Europe/Bucharest');
        $currentDay = $now->dayOfWeekIso; // 1 (Mon) to 7 (Sun)
        $currentHour = $now->format('H:i');

        $isProf = ($user->user_role === 'prof');
        $context = $isProf ? 'professor' : 'group';
        $model = $isProf ? $user : $user->group;

        if (!$model) return null;

        $courses = $this->getTimetableData($model, $context);

        $nextCourseToday = $this->getTimetableData($model, $context)
            ->where('day_of_week', $currentDay)
            ->where('start_hour', '>', $currentHour)
            ->sortBy('start_hour')
            ->first();

        if ($nextCourseToday) return $nextCourseToday;

        $nextInWeek = $courses->filter(fn($c) => $c->day_of_week > $currentDay)
            ->sortBy(['day_of_week', 'start_hour'])
            ->first();

        if ($nextInWeek) return $nextInWeek;

        // 3. Fallback: The first course of the week (e.g., it's Sunday or Friday night)
        return $courses->sortBy(['day_of_week', 'start_hour'])->first();
    }
}
