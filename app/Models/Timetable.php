<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Timetable extends Model
{
    //
    use HasFactory;
    public function subject(): BelongsTo
    {
        return $this->belongsTo(Subject::class);
    }

    public function professor(){
        return $this->subject->professor;
    }

    public function classroom(): BelongsTo
    {
        return $this->belongsTo(Classroom::class);
    }
    public function group(): BelongsTo
    {
        return $this->belongsTo(Group::class);
    }
}
