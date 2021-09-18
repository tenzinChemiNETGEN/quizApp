@extends('layouts.app')

@section('content')

<div class="card">
    <div class="card-body">
        {{-- <h4 class="card-title">Add Questions</h4> --}}
        <div class="container">
            <form action="{{ route('singleQuestion.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                {{-- @include('layouts.inc.message') --}}
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
                <div class="form-group">
                    <label for="subject">Enter Subject Name</label>
                    <input class="form-control" type="text" placeholder="Example Math" name="subject">
                    <label for="subject-image">Upload Subject Image</label>
                    <input type="file" class="form-control-file" id="" name="image">
                </div>

                
                <button type="submit" class="btn btn-primary">Submit Question</button>
            </form>
        </div>
        
        
        
    </div>
</div>

@endsection
