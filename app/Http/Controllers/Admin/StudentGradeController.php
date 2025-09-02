<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StudentGrade;
use App\Models\User;
use App\Models\Grade;
use Illuminate\Http\Request;

class StudentGradeController extends Controller
{
    // Vista general de todas las notas
    public function index()
    {
        $grades = StudentGrade::with(['student', 'grade'])->get();
        $gradesList = Grade::all(); // Para botones de "Asignar nueva nota"
        return view('admin.student_grades.index', compact('grades', 'gradesList'));
    }

    // Crear nota para un grado específico
public function create($gradeId)
{
    $grade = Grade::findOrFail($gradeId);
    $students = User::where('role', 'student')->get();
    return view('admin.student_grades.create', compact('grade', 'students'));
}

    // Guardar nueva nota
public function store(Request $request, $gradeId)
{
    $request->validate([
        'user_id' => 'required|exists:users,id_user',
        'subject' => [
            'required',
            'string',
            'max:100',
            'regex:/^[a-zA-Z\sáéíóúÁÉÍÓÚñÑ]+$/'
        ],
        'period1' => 'nullable|numeric|min:0|max:100',
        'period2' => 'nullable|numeric|min:0|max:100',
        'period3' => 'nullable|numeric|min:0|max:100',
        'period4' => 'nullable|numeric|min:0|max:100',
    ], [
        'subject.regex' => 'El nombre de la materia solo puede contener letras y espacios.',
        'user_id.required' => 'Debe seleccionar un estudiante.',
    ]);

    // Validar que al menos un periodo tenga valor
    if (
        is_null($request->period1) &&
        is_null($request->period2) &&
        is_null($request->period3) &&
        is_null($request->period4)
    ) {
        return back()->withInput()->withErrors(['period1' => 'Debe ingresar al menos un periodo con nota.']);
    }

    // Evitar duplicados exactos (misma materia y estudiante en el mismo grado)
    $exists = StudentGrade::where('user_id', $request->user_id)
        ->where('grade_id', $gradeId)
        ->where('subject', $request->subject)
        ->first();

    if ($exists) {
        return back()->withInput()->withErrors(['subject' => 'Esta materia ya tiene notas asignadas para este estudiante.']);
    }

    // Guardar o actualizar notas
    StudentGrade::updateOrCreate(
        [
            'user_id' => $request->user_id,
            'grade_id' => $gradeId,
            'subject' => $request->subject,
        ],
        $request->only('period1','period2','period3','period4')
    );

    return redirect()->route('admin.student_grades.index')
                     ->with('success', 'Notas asignadas correctamente.');
}


    // Editar nota
    public function edit(StudentGrade $studentGrade)
    {
        return view('admin.student_grades.edit', compact('studentGrade'));
    }

    // Actualizar nota
public function update(Request $request, StudentGrade $studentGrade)
{
    $studentGrade->update($request->only('period1','period2','period3','period4'));
    
    return redirect()->route('admin.student_grades.index')
                     ->with('success', 'Notas actualizadas correctamente.');
}
public function show(StudentGrade $studentGrade)
{
    return redirect()->route('admin.student_grades.index');
}

    // Eliminar nota
    public function destroy(StudentGrade $studentGrade)
    {
        $studentGrade->delete();
        return redirect()->back()->with('success', 'Notas eliminadas correctamente.');
    }
}
