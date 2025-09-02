<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    use HasFactory;

protected $fillable = [
    'name',
    'type',
    'file',
    'grade_id',
];

public function grade()
{
    return $this->belongsTo(Grade::class, 'grade_id');
}
}
