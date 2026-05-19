<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('timetables', function (Blueprint $table) {
            $table->foreign('group_id')->references('id')->on('groups');
            $table->foreign('classroom_id')->references('id')->on('classrooms');
            $table->foreign('subject_id')->references('id')->on('subjects');
        });
    }

    public function down(): void
    {
        Schema::table('timetables', function (Blueprint $table) {
            $table->dropForeign(['group_id']);
            $table->dropForeign(['classroom_id']);
            $table->dropForeign(['subject_id']);
        });
    }
};
