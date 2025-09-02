<?php

namespace App\Http\Controllers;

use App\Models\EvaluationResult;
use App\Models\Evaluation;
use App\Models\User;
use Illuminate\Http\Request;

class EvaluationResultController extends Controller
{
    public function index()
    {
        $results = EvaluationResult::with(['evaluation', 'student'])->get();
        return view('teacher.evaluations.results.index', compact('results'));
    }

    public function create()
    {
        $evaluations = Evaluation::all();
        $students = User::where('role', 'student')->get();
        return view('teacher.evaluations.results.create', compact('evaluations', 'students'));
    }

    public function store(Request $request)
{
    $data = $request->validate([
        'evaluation_id' => 'required|exists:evaluations,id_evaluation',
        'student_id' => 'required|exists:users,id_user',
        'score' => 'nullable|numeric|min:0|max:100',
        'comments' => [
            'nullable',
            'string',
            'max:500',
            'regex:/^[a-zA-Z0-9\s.,áéíóúÁÉÍÓÚñÑ?!-]*$/'
        ],
    ], [
        'comments.regex' => 'Los comentarios solo pueden contener letras, números y signos básicos (. , ? ! -).',
    ]);

    EvaluationResult::create($data);

    return redirect()->route('teacher.evaluation_results.index')
                     ->with('success', 'Resultado de evaluación creado correctamente');
}


    public function edit(EvaluationResult $result)
    {
        $evaluations = Evaluation::all();
        $students = User::where('role', 'student')->get();
        return view('teacher.evaluations.results.edit', compact('result', 'evaluations', 'students'));
    }

   public function update(Request $request, EvaluationResult $result)
{
    $data = $request->validate([
        'evaluation_id' => 'required|exists:evaluations,id_evaluation',
        'student_id' => 'required|exists:users,id_user',
        'score' => 'nullable|numeric|min:0|max:100',
        'comments' => [
            'nullable',
            'string',
            'max:500',
            'regex:/^[a-zA-Z0-9\s.,áéíóúÁÉÍÓÚñÑ?!-]*$/'
        ],
    ], [
        'comments.regex' => 'Los comentarios solo pueden contener letras, números y signos básicos (. , ? ! -).',
    ]);

    $result->update($data);

    return redirect()->route('teacher.evaluation_results.index')
                     ->with('success', 'Resultado de evaluación actualizado correctamente');
}

    public function destroy(EvaluationResult $result)
    {
        $result->delete();
        return redirect()->route('teacher.evaluation_results.index')
                         ->with('success', 'Resultado de evaluación eliminado correctamente');
    }

    public function show(EvaluationResult $result)
    {
        $result->load(['evaluation', 'student']);
        return view('teacher.evaluations.results.show', compact('result'));
    }
}
