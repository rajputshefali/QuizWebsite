<?php

namespace App\Imports;


use App\Modules\Admin\Models\Question;
use Maatwebsite\Excel\Concerns\ToModel;


class QuestionImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Question([
            'question' => $row[0],
            'option1' => $row[1],
            'option2' => $row[2],
            'option3' => $row[3],
            'option4' => $row[4],
            'answer' => $row[5],
            'category' =>$row[6]
        ]);
    }
}
