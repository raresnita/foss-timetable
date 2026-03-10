<?php

namespace App\Http\Controllers;

use App\Models\User;

class ProfessorController
{
    public function __invoke()
    {
        $professors = User::where('user_role', 'prof')->get();
        return view('items-grid', ['items' => $professors, 'context' => 'professors']);
    }
}
