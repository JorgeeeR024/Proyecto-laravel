<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentGrade extends Model
{
    use HasFactory;

    protected $table = 'student_grades'; // nombre de la tabla en BD

    protected $primaryKey = 'id'; // si tu PK se llama distinto, cámbialo aquí

    protected $fillable = [
        'user_id',
        'grade_id',
        'subject',
        'period1',
        'period2',
        'period3',
        'period4',
    ];

    // Relación con el estudiante (usuario)
    public function student()
    {
        return $this->belongsTo(User::class, 'user_id', 'id_user');
    }

    // Relación con el grado
    public function grade()
    {
        return $this->belongsTo(Grade::class, 'grade_id', 'id_grade');
    }
}
