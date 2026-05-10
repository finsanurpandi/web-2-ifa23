<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Department;
use App\Models\Lecturer;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreLecturerRequest;
use Illuminate\Support\Facades\Mail;
use App\Mail\TestMail;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $users = User::query()->with('department')->paginate(7);
        // $users = User::withTrashed()->with('department')->paginate(7);
        $users = User::onlyTrashed()->with('department')->paginate(7);
        
        // User::where('id', 6)->forceDelete();
        // withTrashed() Adalah method yang menampilkan keseluruhan data beserta dengan data yang telah dihapus
        // onlyTrashed() adalah method yang hanya menampilkan data yang telah dihapus
        // restore() adalah method untuk mengembalikan data yang telah dihapus
        // forceDelete() adalah method untuk menghapus data dari basis data
        // restoreAll() adalah method untuk mengembalikan keseluruhan data yang telah dihapus
        // forceDeleteAll() adalah methos untuk menghapus keseluruhan data data basis data.

        $penerima = [
            'penerima1@mail.com',
            'penerima2@mail.com',
            'penerima3@mail.com',
            'penerima4@mail.com',
            'penerima5@mail.com',
            'penerima6@mail.com',
            'penerima7@mail.com',
            'penerima8@mail.com',
            'penerima9@mail.com',
            'penerima0@mail.com',
        ];

        foreach($penerima as $pen) {
            Mail::to($pen)->send(new TestMail());
        }
        

        return view('user_index', compact('users'));
    }

    public function user_form_lecturer()
    {
        $departments = Department::all();
        return view('user_form_lecturer', compact('departments'));
    }

    public function user_store_lecturer(StoreLecturerRequest $req)
    {
        // $validated = $req->validate([
        //     'username' => 'required|min:8',
        //     'firstname' => 'required|string',
        //     'lastname' => 'required|string',
        //     'email' => 'required|email',
        //     'password' => 'required|min:8'
        // ]);

        // $validated['department_id'] = $req->department_id;
        // $validated['role'] = 1;

        // $user = User::create($validated);
        
        // $user = User::create([
        //     'username' => $req->username,
        //     'firstname' => $req->firstname,
        //     'lastname' => $req->lastname,
        //     'email' => $req->email,
        //     'password' => Hash::make($req->password),
        //     'department_id' => $req->department_id,
        //     'role' => 1
        // ]);

        // Lecturer::create([
        //     'nidn' => $req->nidn,
        //     'address' => $req->address,
        //     'user_id' => $user->id
        // ]);

        $user = User::create($req->safe()->except(['nidn', 'address']));

        $validationLecturer = $req->safe()->only(['nidn', 'address']);
        $validationLecturer['user_id'] = $user->id;
        Lecturer::create($validationLecturer);

        return redirect()->route('user.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
