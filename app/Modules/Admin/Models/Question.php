<?php

namespace App\Modules\Admin\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;
    protected $fillable=['question', 'option1', 'option2', 'option3', 'option4', 'answer', 'category'];
    public function next()
{
    return static::where($this->getKeyName(), '>', $this->getKey())->first();
}
}
