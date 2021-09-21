@extends('layouts.app')

@section('content')

<div class="card">
    <div class="card-body">
        <div class="container">
            <form action="{{ route('singlequestion.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @include('layouts.inc.message')
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

                @if($subjects->count() > 0)
                    <div class="form-group">
                        <label for="correct_answer">Select Subject</label>
                        <select class="form-control" id="id" name="subject">
                            @foreach ($subjects as $subject)
                                <option value="{{ $subject->id }}">{{ $subject->subject }}</option>
                            @endforeach
                        </select>
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
                            <span class="input-group-text">A</span>
                            </div>
                            <input class="form-control" type="text" placeholder="Example: 12" name="answer1">
                            <div class="input-group-prepend">
                                <span class="input-group-text">B</span>
                            </div>
                            <input class="form-control" type="text" placeholder="Example: 3" name="answer2">

                        </div>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">C</span>
                            </div>
                            <input class="form-control" type="text" placeholder="Example: 41" name="answer3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">D</span>
                            </div>
                            <input class="form-control" type="text" placeholder="Example: 5" name="answer4">
                        </div>

                        <label for="correct_answer">Select Correct</label>
                        <select class="form-control" id="correct_answer" name="correct_answer">
                        <option value="1">A</option>
                        <option value="2">B</option>
                        <option value="3">C</option>
                        <option value="4">D</option>
                        </select>
                        <label for="exampleFormControlTextarea1">Description of Answer</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="description"></textarea>
                        <label for="Difficulty level">Select Correct</label>
                        <select class="form-control" id="difficulty_level" name="difficulty_level">
                        <option value="1">Easy</option>
                        <option value="5">Medius</option>
                        <option value="10">Hard</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit Question</button>
                </form>
                @else
                    <div class="alert alert-primary" role="alert">
                        <strong>There is no subject to choose</strong> 
                        <a href="{{ route('subject.create') }}" class="alert-link">Create Subject</a>
                    </div>
                @endif
        </div>
    </div>
</div>

@endsection
