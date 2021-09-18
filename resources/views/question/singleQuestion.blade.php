@extends('layouts.app')

@section('content')

<div class="card">
    <div class="card-body">
        {{-- <h4 class="card-title">Add Questions</h4> --}}
        <div class="container">
            <form action="{{ route('singleQuestion.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="subject">Enter Subject Name</label>
                    <input class="form-control" type="text" placeholder="Example Math" name="subject">
                    <label for="subject-image">Upload Subject Image</label>
                    <input type="file" class="form-control-file" id="" name="image">
                </div>

                <div class="form-group">
                    <label for="subject Topic">Enter Subject Topic</label>
                    <input class="form-control" type="text" placeholder="Example linear equation" name="topic">
                    <label for="subject Topic">Language</label>
                    <select class="form-control" id="exampleFormControlSelect1" name="language">
                        <option>English</option>
                        <option>Hindi</option>
                    </select>
                    <label for="topic_image">Upload Topic Image</label>
                    <input type="file" class="form-control-file" id="" name="images">
                </div>  

                <div class="form-group">
                    <label for="Question">Enter Question</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-question-circle" aria-hidden="true"></i></span>
                        </div>
                        <input class="form-control" type="text" placeholder="Example: What is the ....?" name="question">
                    </div>
                    <label for="Answer">Enter Answers</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text">1</span>
                        </div>
                        <input class="form-control" type="text" placeholder="Example: 12" name="answer1">
                        <div class="input-group-prepend">
                            <span class="input-group-text">2</span>
                        </div>
                        <input class="form-control" type="text" placeholder="Example: 3" name="answer2">

                    </div>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">3</span>
                        </div>
                        <input class="form-control" type="text" placeholder="Example: 41" name="answer3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">4</span>
                        </div>
                        <input class="form-control" type="text" placeholder="Example: 5" name="answer4">
                    </div>
                    
                    <label for="correct_answer">Select Correct</label>
                    <select class="form-control" id="exampleFormControlSelect1" name="correct_answer">
                      <option>1</option>
                      <option>2</option>
                      <option>3</option>
                      <option>4</option>
                    </select>
                    <label for="exampleFormControlTextarea1">Description of Answer</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="description"></textarea>
                    <label for="Difficulty level">Select Correct</label>
                    <select class="form-control" id="" name="difficulty_level">
                      <option>Easy</option>
                      <option>Medius</option>
                      <option>Hard</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Submit Question</button>
            </form>
        </div>
        
        
        
    </div>
</div>

@endsection
