<?php

namespace App\Modules\User\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamAnswer extends Model
{
    use HasFactory;
    public $table = "exams_answers";
    protected $fillable=['user_id', 'question_id', 'answer'];
}
