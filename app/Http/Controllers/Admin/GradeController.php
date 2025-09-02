<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Grade;
use App\Models\User;
use Illuminate\Http\Request;

class GradeController extends Controller
{
    // Mostrar todos los grados
    public function index()
    {
        $grades = Grade::all();
        return view('admin.grades.index', compact('grades'));
    }

    // Formulario para crear un grado
    public function create()
    {
        return view('admin.grades.create');
    }

    // Guardar un nuevo grado
   public function store(Request $request)
{
    $request->validate([
        'name' => ['required', 'string', 'max:255', 'regex:/^[a-zA-Z\sáéíóúÁÉÍÓÚñÑ]+$/']
    ], [
        'name.regex' => 'El nombre del grado solo puede contener letras y espacios.'
    ]);

    Grade::create($request->only('name'));

    return redirect()->route('admin.grades.index')->with('success', 'Grado creado correctamente.');
}


    // Formulario para editar un grado
    public function edit(Grade $grade)
    {
        return view('admin.grades.edit', compact('grade'));
    }

    // Actualizar un grado
  public function update(Request $request, Grade $grade)
{
    $request->validate([
        'name' => ['required', 'string', 'max:255', 'regex:/^[a-zA-Z\sáéíóúÁÉÍÓÚñÑ]+$/']
    ], [
        'name.regex' => 'El nombre del grado solo puede contener letras y espacios.'
    ]);

    $grade->update($request->only('name'));

    return redirect()->route('admin.grades.index')->with('success', 'Grado actualizado correctamente.');
}

    // Eliminar un grado
    public function destroy(Grade $grade)
    {
        $grade->delete();
        return redirect()->route('admin.grades.index')->with('success', 'Grado eliminado correctamente.');
    }

    // Mostrar estudiantes de un grado
    public function showStudents($gradeId)
    {
        $grade = Grade::with(['users' => function($query) {
            $query->where('role', 'student');
        }])->findOrFail($gradeId);

        // Traer estudiantes que aún no tienen grado para asignar
        $studentsWithoutGrade = User::where('role', 'student')->whereNull('grade_id')->get();

        return view('admin.grades.students', compact('grade', 'studentsWithoutGrade'));
    }

    // Asignar estudiante a un grado
    public function assignStudent(Request $request, $gradeId)
    {
        $request->validate([
            'student_id' => 'required|exists:users,id_user',
        ]);

        $student = User::findOrFail($request->student_id);
        $student->grade_id = $gradeId;
        $student->save();

        return redirect()->route('admin.grades.students', $gradeId)
                         ->with('success', 'Estudiante asignado correctamente.');
    }
}
