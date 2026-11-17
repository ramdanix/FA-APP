<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\Application;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $assignments = Assignment::with('submissions')->latest()->get();
        $applications = Application::latest()->get();
        return view('admin.dashboard', compact('assignments', 'applications'));
    }

    public function storeAssignment(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'course_name' => 'required|string',
            'class_name' => 'required|string',
            'allowed_extensions' => 'required|string',
            'deadline' => 'required|date',
        ]);

        Assignment::create($request->all());

        return redirect()->route('admin.dashboard')->with('success', 'Tugas / Laprak berhasil dipublikasikan!');
    }
}
