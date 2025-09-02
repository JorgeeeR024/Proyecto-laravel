<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Material;
use App\Models\Grade;

class MaterialController extends Controller
{
public function index()
{
    $grades = Grade::withCount('students')->get(); // trae TODOS los grados
    return view('teacher.gestion_grades.index', compact('grades'));
}


    public function show($id)
    {
        $grade = Grade::with(['students','materials','teachers'])->findOrFail($id);

        if (! $grade->teachers->pluck('id_user')->contains(auth()->id())) {
            abort(403, 'No tienes permiso para ver este grado.');
        }

        return view('teacher.gestion_grades.show', compact('grade'));
    }

public function store(Request $request, $id)
{
    $grade = Grade::with('teachers')->findOrFail($id);
    $teacherId = auth()->id();

    // Comprobamos si el profesor es el principal o está en la relación de múltiples profesores
    $hasAccess = $grade->teacher_id === $teacherId || $grade->teachers()->where('id_user', $teacherId)->exists();

    if (! $hasAccess) {
        abort(403, 'No tienes permiso para agregar materiales.');
    }

    $request->validate([
        'name' => 'required|string|max:255',
        'type' => 'required|in:PDF,Video,Link',
        'file' => 'required_if:type,PDF,Video|file|max:10240',
        'url' => 'nullable|url',

    ]);

    $material = new Material();
    $material->grade_id = $grade->id_grade;
    $material->name = $request->name;
    $material->type = $request->type;

    if ($request->type === 'Link') {
        $material->file = $request->url;
    } else {
        $material->file = $request->file('file')->store('materials','public');
    }

    $material->save();

    return redirect()->back()->with('success', 'Material agregado correctamente.');
}

}
