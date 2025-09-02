<?php

namespace App\Http\Controllers;

use App\Models\Evaluation;
use App\Models\Grade;
use App\Models\Subject;
use Illuminate\Http\Request;

class EvaluationController extends Controller
{
    public function index()
    {
        $evaluations = Evaluation::with(['grade', 'subject', 'results'])->get();
        return view('teacher.evaluations.index', compact('evaluations'));
    }

    public function create()
    {
        $grades = Grade::all();
        $subjects = Subject::all();
        return view('teacher.evaluations.create', compact('grades', 'subjects'));
    }

    public function store(Request $request)
{
    $data = $request->validate([
        'subject_id' => 'required|exists:subjects,id_subject',
        'grade_id' => 'required|exists:grades,id_grade',
        'type' => 'required|in:quiz,exam,assignment,project',
        'title' => [
            'required',
            'string',
            'max:255',
            'regex:/^[a-zA-Z\sáéíóúÁÉÍÓÚñÑ]+$/'
        ],
        'description' => [
            'nullable',
            'string',
            'max:500',
            'regex:/^[a-zA-Z0-9\s.,áéíóúÁÉÍÓÚñÑ?!-]*$/'
        ],
        'total_score' => 'required|numeric|min:0',
        'date' => 'required|date',
    ], [
        'title.regex' => 'El título solo puede contener letras y espacios.',
        'description.regex' => 'La descripción solo puede contener letras, números y signos básicos (. , ? ! -).',
    ]);

    Evaluation::create($data);

    return redirect()->route('teacher.evaluations.index')
                     ->with('success', 'Evaluación creada correctamente');
}
    public function edit(Evaluation $evaluation)
    {
        $grades = Grade::all();
        $subjects = Subject::all();
        return view('teacher.evaluations.edit', compact('evaluation', 'grades', 'subjects'));
    }

   public function update(Request $request, Evaluation $evaluation)
{
    $data = $request->validate([
        'subject_id' => 'required|exists:subjects,id_subject',
        'grade_id' => 'required|exists:grades,id_grade',
        'type' => 'required|in:quiz,exam,assignment,project',
        'title' => [
            'required',
            'string',
            'max:255',
            'regex:/^[a-zA-Z\sáéíóúÁÉÍÓÚñÑ]+$/'
        ],
        'description' => [
            'nullable',
            'string',
            'max:500',
            'regex:/^[a-zA-Z0-9\s.,áéíóúÁÉÍÓÚñÑ?!-]*$/'
        ],
        'total_score' => 'required|numeric|min:0',
        'date' => 'required|date',
    ], [
        'title.regex' => 'El título solo puede contener letras y espacios.',
        'description.regex' => 'La descripción solo puede contener letras, números y signos básicos (. , ? ! -).',
    ]);

    $evaluation->update($data);

    return redirect()->route('teacher.evaluations.index')
                     ->with('success', 'Evaluación actualizada correctamente');
}


    public function destroy(Evaluation $evaluation)
    {
        $evaluation->delete();
        return redirect()->route('teacher.evaluations.index')
                         ->with('success', 'Evaluación eliminada correctamente');
    }

    public function show(Evaluation $evaluation)
    {
        $evaluation->load('results.student');
        return view('teacher.evaluations.show', compact('evaluation'));
    }
}
