<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $latestUsers = User::latest()->take(5)->get();        // Últimos usuarios
        $usersCount   = User::count();                        // Total usuarios
        $studentsCount= User::where('role', 'student')->count(); // Total estudiantes
        $teachersCount= User::where('role', 'teacher')->count(); // Total profesores
        $totalUsers   = $usersCount;                          // Para sección estadísticas
        $totalStudents= $studentsCount;
        $totalTeachers= $teachersCount;

        return view('admin.dashboard', compact(
            'latestUsers', 
            'usersCount', 
            'studentsCount', 
            'teachersCount', 
            'totalUsers', 
            'totalStudents', 
            'totalTeachers'
        ));
    }
}
