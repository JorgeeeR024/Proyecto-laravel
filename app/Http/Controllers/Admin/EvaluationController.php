<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Evaluation;
use App\Models\User;
use App\Models\Subject;
use App\Models\Grade;
use Illuminate\Http\Request;

class EvaluationController extends Controller
{
    public function index()
    {
        $evaluations = Evaluation::with(['user', 'subject', 'grade'])->get();
        return view('admin.evaluations.index', compact('evaluations'));
    }

    public function create()
    {
        $users = User::all();
        $subjects = Subject::all();
        $grades = Grade::all(); // NUEVO
        return view('admin.evaluations.create', compact('users', 'subjects', 'grades'));
    }

  public function store(Request $request)
{
    $request->validate([
        'user_id' => 'required|exists:users,id_user',
        'grade_id' => 'required|exists:grades,id_grade',
        'subject_id' => 'required|exists:subjects,id_subject',
        'score.self' => 'required|numeric|min:0|max:100',
        'score.peer' => 'required|numeric|min:0|max:100',
        'score.teacher' => 'required|numeric|min:0|max:100',
        'comments.self' => 'nullable|string|max:500',
        'comments.peer' => 'nullable|string|max:500',
        'comments.teacher' => 'nullable|string|max:500',
    ]);

    $types = ['self', 'peer', 'teacher'];

    foreach ($types as $type) {
        Evaluation::create([
            'user_id' => $request->user_id,
            'grade_id' => $request->grade_id,
            'subject_id' => $request->subject_id,
            'type' => $type,
            'score' => $request->score[$type],
            'comments' => $request->comments[$type] ?? null,
        ]);
    }

    return redirect()->route('admin.evaluations.index')->with('success', 'Las 3 evaluaciones se crearon correctamente.');
}

    public function edit(Evaluation $evaluation)
    {
        $users = User::all();
        $subjects = Subject::all();
        $grades = Grade::all(); // NUEVO
        return view('admin.evaluations.edit', compact('evaluation', 'users', 'subjects', 'grades'));
    }

    public function update(Request $request, Evaluation $evaluation)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id_user',
            'subject_id' => 'required|exists:subjects,id_subject',
            'grade_id' => 'required|exists:grades,id_grade',
            'type' => 'required|string|max:100',
            'score' => 'required|numeric|min:0|max:100',
            'comments' => 'nullable|string|max:500',
        ]);

        $evaluation->update($request->all());
        return redirect()->route('admin.evaluations.index')->with('success', 'Evaluación actualizada correctamente.');
    }

    public function destroy(Evaluation $evaluation)
    {
        $evaluation->delete();
        return redirect()->route('admin.evaluations.index')->with('success', 'Evaluación eliminada correctamente.');
    }
}
