<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\StudentGrade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeacherGradeController extends Controller
{
    // Mostrar solo los estudiantes del grado del profesor
    public function index()
    {
        $teacher = Auth::user();

        // Suponiendo que tenés relación grade_teacher
        $gradeId = $teacher->grades()->pluck('id_grade')->first();

        $grades = StudentGrade::with('student')
            ->where('grade_id', $gradeId)
            ->get();

        return view('teacher.student_grades.index', compact('grades'));
    }
    public function create()
{
    $teacher = Auth::user();
    $gradeId = $teacher->grades()->pluck('id_grade')->first(); // su grado

    $students = \App\Models\User::where('role','student')
                 ->where('grade_id', $gradeId) // solo sus estudiantes
                 ->get();

    return view('teacher.student_grades.create', compact('students', 'gradeId'));
}

public function store(Request $request)
{
    $teacher = Auth::user();
    $gradeId = $teacher->grades()->pluck('id_grade')->first(); // su grado

    $request->validate([
        'user_id' => 'required|exists:users,id_user',
        'subject' => ['required','string','max:100','regex:/^[a-zA-Z\sáéíóúÁÉÍÓÚñÑ]+$/'],
        'period1' => 'nullable|numeric|min:0|max:100',
        'period2' => 'nullable|numeric|min:0|max:100',
        'period3' => 'nullable|numeric|min:0|max:100',
        'period4' => 'nullable|numeric|min:0|max:100',
    ], [
        'subject.regex' => 'El nombre de la materia solo puede contener letras y espacios.',
    ]);

    // Validar que al menos un periodo tenga nota
    if (is_null($request->period1) &&
        is_null($request->period2) &&
        is_null($request->period3) &&
        is_null($request->period4)) {
        return back()->withInput()->withErrors(['period1' => 'Debe ingresar al menos un periodo con nota.']);
    }

    // Evitar duplicados exactos
    $exists = \App\Models\StudentGrade::where('user_id', $request->user_id)
        ->where('grade_id', $gradeId)
        ->where('subject', $request->subject)
        ->first();

    if ($exists) {
        return back()->withInput()->withErrors(['subject' => 'Esta materia ya tiene notas asignadas para este estudiante.']);
    }

    \App\Models\StudentGrade::updateOrCreate(
        [
            'user_id' => $request->user_id,
            'grade_id' => $gradeId,
            'subject' => $request->subject,
        ],
        $request->only('period1','period2','period3','period4')
    );

    return redirect()->route('teacher.student_grades.index')
                     ->with('success', 'Notas creadas correctamente.');
}



    // Editar nota (solo profesor)
    public function edit(StudentGrade $studentGrade)
    {
        // Validar que el profesor solo edite su propio grado
        $teacherGradeIds = auth()->user()->grades()->pluck('id_grade');
        if (!in_array($studentGrade->grade_id, $teacherGradeIds->toArray())) {
            abort(403, 'No tiene permiso para editar esta nota.');
        }

        return view('teacher.student_grades.edit', compact('studentGrade'));
    }

    public function update(Request $request, StudentGrade $studentGrade)
{
    $teacherGradeIds = auth()->user()->grades()->pluck('id_grade');
    if (!in_array($studentGrade->grade_id, $teacherGradeIds->toArray())) {
        abort(403, 'No tiene permiso para actualizar esta nota.');
    }

    $request->validate([
        'period1' => 'nullable|numeric|min:0|max:100',
        'period2' => 'nullable|numeric|min:0|max:100',
        'period3' => 'nullable|numeric|min:0|max:100',
        'period4' => 'nullable|numeric|min:0|max:100',
    ]);

    // Validar que al menos un periodo tenga nota
    if (is_null($request->period1) &&
        is_null($request->period2) &&
        is_null($request->period3) &&
        is_null($request->period4)) {
        return back()->withInput()->withErrors(['period1' => 'Debe ingresar al menos un periodo con nota.']);
    }

    $studentGrade->update($request->only('period1','period2','period3','period4'));

    return redirect()->route('teacher.student_grades.index')
                     ->with('success', 'Notas actualizadas correctamente.');
}

}
