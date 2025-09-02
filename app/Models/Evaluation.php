<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    use HasFactory;

    protected $table = 'evaluations';
    protected $primaryKey = 'id_evaluation';

    protected $fillable = [
        'subject_id',
        'grade_id',
        'type',
        'title',
        'description',
        'total_score',
        'date',
    ];

    // Relación con subject
    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id', 'id_subject');
    }

    // Relación con grade
    public function grade()
    {
        return $this->belongsTo(Grade::class, 'grade_id', 'id_grade');
    }
     protected $casts = [
        'date' => 'datetime', // <- esto convierte automáticamente a Carbon
    ];


    // Relación con resultados
    public function results()
    {
        return $this->hasMany(EvaluationResult::class, 'evaluation_id', 'id_evaluation');
    }
}
