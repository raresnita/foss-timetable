<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    public function __invoke(){
        $groups = Group::get();
        return view('groups.index', compact('groups'));
    }
}
