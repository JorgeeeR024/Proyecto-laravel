<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Grade;

class TeacherDashboardController extends Controller
{
    public function index()
    {
        $teacher = Auth::user();

        // Si tienes relación muchos a muchos con "grades"
        $grades = $teacher->grades()->with('students')->get();

        return view('teacher.dashboard', compact('grades'));
    }
}
