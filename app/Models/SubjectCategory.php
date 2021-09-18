<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubjectCategory extends Model
{
    use HasFactory;

    protected $fillable=[
        'topic',
        'language',
        'year',
        'image',
        'subjects_id'
    ];
}
