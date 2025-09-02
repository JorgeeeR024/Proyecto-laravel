<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EvaluationResult extends Model
{
    use HasFactory;

    protected $table = 'evaluation_results';
    protected $primaryKey = 'id_result';

    protected $fillable = [
        'evaluation_id',
        'student_id',
        'score',
        'comments',
    ];

    // Relación con evaluation
    public function evaluation()
    {
        return $this->belongsTo(Evaluation::class, 'evaluation_id', 'id_evaluation');
    }

    // Relación con student (usuario)
    public function student()
    {
        return $this->belongsTo(User::class, 'student_id', 'id_user');
    }
}
