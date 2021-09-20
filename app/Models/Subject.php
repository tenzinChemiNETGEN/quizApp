<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Subject extends Model
{
    use HasFactory;

    protected $fillable=[
        'subject',
        'image',
    ];

    public function subjectCategory(){
        return $this->hasMany(SubjectCategory::class);
    }

    



    

}
