@extends('layouts.app')

@section('content')
@include('layouts.inc.message')
<div class="row">
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Edit Question</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('question') }}"> Back</a>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-body">
        <form action="{{ route('question.update',$question->id) }}" method="POST"> 
            @csrf
            @method('PUT')
             <div class="row">
                <div class="col-sm-8 ">
                    <div class="form-group">
                        <strong>Question:</strong>
                        <input type="text" name="question" value="{{ $question->question }}" class="form-control" placeholder="Name">
                    </div>
                </div> 
             </div>

                <label for="Answer">Enter Answers</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                            <span class="input-group-text">A</span>
                            </div>
                            <input class="form-control" type="text" placeholder="{{ $question->answer1 }}" name="answer1">
                            <div class="input-group-prepend">
                                <span class="input-group-text">B</span>
                            </div>
                            <input class="form-control" type="text" placeholder="{{ $question->answer2 }}" name="answer2">

                        </div>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">C</span>
                            </div>
                            <input class="form-control" type="text" placeholder="{{ $question->answer3 }}" name="answer3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">D</span>
                            </div>
                            <input class="form-control" type="text" placeholder="{{ $question->answer4 }}" name="answer4">
                        </div>

                        <label for="correct_answer">Select Correct</label>
                        
                        <select class="form-control" id="correct_answer" name="correct_answer">
                            <option value="1">A</option>
                            <option value="2">B</option>
                            <option value="3">C</option>
                            <option value="4">D</option>
                        </select>
                        <label for="exampleFormControlTextarea1">Description of Answer</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="description">{{ $question->description }}</textarea>
                        
                        <label for="Difficulty level">Select Correct</label>
                        <select class="form-control" id="difficulty_level" name="difficulty_level">
                        <option value="1">Easy</option>
                        <option value="5">Medius</option>
                        <option value="10">Hard</option>
                        </select>
                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
        </form>

        
    </div>
</div>
@endsection