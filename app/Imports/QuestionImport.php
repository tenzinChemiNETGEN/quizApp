<?php

namespace App\Imports;

use App\Models\Question;
use App\Models\Subject;
use App\Models\SubjectCategory;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithMappedCells;

class QuestionImport implements ToCollection, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
        foreach($rows as $row)
        {
            $subject=Subject::create([
                'subject'=>$row['subject'],
            ]);

            $category=SubjectCategory::create([
                'topic' => $row['category'],
                'language' => $row['language'],
                'subjects_id' => $subject->id,
            ]);

            Question::create([
                'question' => $row['question'],
                'answer1' =>$row['answer1'],
                'answer2' =>$row['answer2'],
                'answer3' =>$row['answer3'],
                'answer4' =>$row['answer4'],
                'correct_answer' => $row['correct_answer'],
                'description' => $row['description'],
                'difficulty_level' => $row['difficulty_level'],
                'subject_categoryId' => $category->id,
            ]);
            
            
        }
        
    }
}
