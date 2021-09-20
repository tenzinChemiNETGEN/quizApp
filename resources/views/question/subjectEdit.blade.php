@extends('layouts.app')

@section('content')
@include('layouts.inc.message')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Edit Subject</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('singleQuestion.create') }}"> Back</a>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-body">
        <form action="{{ route('subject.update',$subjects->id) }}" method="POST" enctype="multipart/form-data"> 
            @csrf
            @method('PUT')
             <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Image:</strong>
                        <input type="file" name="image" class="form-control" placeholder="image">
                        <img src="/image/{{ $subjects->image }}" width="300px">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Name:</strong>
                        <input type="text" name="subject" value="{{ $subjects->subject }}" class="form-control" placeholder="Name">
                    </div>
                </div> 
                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
         
        </form>

        
    </div>
</div>
@endsection