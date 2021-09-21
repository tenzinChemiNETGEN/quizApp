@extends('layouts.app')

@section('content')
    
<div class="container m-1">
    <div class="row justify-content-center">
        <div class="col-4">
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <form action="{{ route('excel.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <label for="">IMPORT QUESTIONS HERE</label>
                            <input type="file" class="form-control-file" name="questionFile" >
                            <small id="fileHelpId" class="form-text text-muted">Excel Format only</small>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
   
@endsection