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

    /**
     * To check if subject is already there or not
     */
    public function hasSubject(Request $request)
    {
        try{
            return $this->where('subject',$request->subject)->first();
        }
        catch(Exception $e){
            return $e;
        }
    }

}
