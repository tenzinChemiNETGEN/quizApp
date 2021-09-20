@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-body">
            @if($subjects->count() > 0)
                <label for="subject">Select Subject</label>
                <select class="form-control" id="subject" name="subject">
                    @foreach ($subjects as $subject)
                        <option value="{{ $subject->id }}">{{ $subject->subject }}</option>
                    @endforeach
                </select>

                <label for="topics"> Select Subject Topics </label>
                <select class="form-control" name="topic" id="topic" required>
                <option value=""> Select </option>
                @foreach($subject_category as $subCategory)
                    <option value="{{ $subCategory->id }}"> {{ $subCategory->name }}</option>
                @endforeach
            </select>
   
            @else
                <div class="alert alert-primary" role="alert">
                    <strong>There is no subject to choose</strong> 
                    <a href="{{ route('subject.create') }}" class="alert-link">Create Subject</a>
                </div>
            @endif
        </div>
    </div>

@endsection

@section('js')

<script src="/js/jquery.dataTables.min.js"></script>

<script src="/js/dataTables.bootstrap4.min.js"></script>

<script src="/js/dataTables.buttons.min.js"></script>

<script src="/js/vfs_fonts.js"></script>

<script src="/js/buttons.html5.min.js"></script>

 <script type="text/javascript">
            $(function()
            {
                    jQuery('select[name="subject"]').on('change',function(){
                       var subjectID = jQuery(this).val();
                       if(subjectID)
                       {
                          jQuery.ajax({
                             url : 'question/category' +subjectID,
                             type : "GET",
                             dataType : "json",
                             success:function(data)
                             {
                                console.log(data);
                                jQuery('select[name="topic"]').empty();
                                jQuery.each(data, function(key,value){
                                   $('select[name="topic"]').append('<option value="'+ key +'">'+ value +'</option>');
                                });
                             }
                          });
                       }
                       else
                       {
                          $('select[name="subCategory"]').empty();
                       }
                    });
            });
</script>


@stop