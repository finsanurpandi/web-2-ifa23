<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class TestController extends Controller
{
    public function index()
    {
        $users = User::all();

        // get untuk multiple row
        // first untuk single row
        // return view('sdbhbsf', $data);
        // dd($users[0]->fullname);
        // dd($users[0]->full_name);
        // dd($users[0]->fullName);

        // ENUM
        dd($users[0]->department_id->getLabel());
    }
}
