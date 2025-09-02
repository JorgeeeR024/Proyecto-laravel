<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use Illuminate\Http\Request;

class GradeController extends Controller
{
    public function index()
    {
        return Grade::with(['students', 'teachers', 'evaluations'])->get();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => [
                'required',
                'string',
                'max:50',
'regex:/^[A-Za-zÁÉÍÓÚáéíóúÑñ]+(?:\s[A-Za-zÁÉÍÓÚáéíóúÑñ]+)*$/'


            ],
            'teacher_id' => 'nullable|exists:users,id_user',
        ], [
            'name.regex' => 'El nombre del grado solo puede contener letras y espacios.'
        ]);

        return Grade::create($data);
    }

    public function show(Grade $grade)
    {
        return $grade->load(['students', 'teachers', 'evaluations']);
    }

    public function update(Request $request, Grade $grade)
    {
        $data = $request->validate([
            'name' => [
                'required',
                'string',
                'max:50',
                'regex:/^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/'
            ],
            'teacher_id' => 'nullable|exists:users,id_user',
        ], [
            'name.regex' => 'El nombre del grado solo puede contener letras y espacios.'
        ]);

        $grade->update($data);

        return $grade;
    }

    public function destroy(Grade $grade)
    {
        $grade->delete();
        return response()->noContent();
    }
}
