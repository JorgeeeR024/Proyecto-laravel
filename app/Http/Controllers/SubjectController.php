<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function index()
    {
        return Subject::all();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|unique:subjects,name',
        ]);

        return Subject::create($data);
    }

    public function show(Subject $subject)
    {
        return $subject->load('evaluations'); // trae evaluaciones relacionadas
    }

    public function update(Request $request, Subject $subject)
    {
        $data = $request->validate([
            'name' => 'required|string|unique:subjects,name,' . $subject->id_subject,
        ]);

        $subject->update($data);

        return $subject;
    }

    public function destroy(Subject $subject)
    {
        $subject->delete();
        return response()->noContent();
    }
}
