<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Classroom;
use App\Models\Group;
use Illuminate\Http\Request;


class AdminController extends Controller
{
    public function manageUsers()
    {
        $items = User::orderBy('name')->paginate(10);

        return view('admin.users.index', compact('items'));
    }

    public function manageClassrooms()
    {
        $items = Classroom::orderBy('id')->paginate(10);

        return view('admin.classrooms.index', compact('items'));
    }

    public function manageGroups()
    {
        $items = Group::orderBy('id')->paginate(10);

        return view('admin.groups.index', compact('items'));
    }
}
