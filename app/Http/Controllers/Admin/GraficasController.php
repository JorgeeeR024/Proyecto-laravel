<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class GraficasController extends Controller
{
    public function index()
    {
        // Contar usuarios por rol
        $roles = User::selectRaw('role, COUNT(*) as total')
            ->groupBy('role')
            ->pluck('total', 'role');

        // Contar usuarios por grado
        $grades = User::selectRaw('grade_id, COUNT(*) as total')
            ->groupBy('grade_id')
            ->pluck('total', 'grade_id');

        // Total de usuarios
        $totalUsers = User::count();

        return view('admin.graficas.index', compact('roles', 'grades', 'totalUsers'));
    }
}
