@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-body">
            @if($subjects->count() > 0)
                <div class="row">
                    <div class="col-sm-5">
                        <label for="subject">Select Subject</label>
                        <select class="form-control" id="subject" name="subject">
                            <option value="">Select Subject</option>
                            @foreach ($subjects as $subject)
                                <option value="{{ $subject->id }}">{{ $subject->subject }}</option>
                            @endforeach
                        </select>
                        <label for="subject category">Select Subject Category</label>
                        <select class="form-control" id="category" name="category">
                            <option value="">Select Subject Category</option>
                        </select>
                    </div>
                </div>
                <hr>
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Questions</h4>
                        <table class="table data-table">
                            <thead>
                                <tr>
                                    <th>Question</th>
                                    <th width="280px">Action</th>
                                </tr>
                            </thead>
                            <tbody>
        
                            </tbody>
                        </table>
                    </div>
                </div>
                
            @else
                <div class="alert alert-primary" role="alert">
                    <strong>There is no question to choose</strong>
                    <a href="{{ route('subject.create') }}" class="alert-link">Create Subject</a>
                </div>
            @endif
        </div>
    </div>

    <div class="modal fade" id="modelDelete" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fa fa-exclamation-triangle"></i>  Confirm</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this question?
                    <small><p class="text-danger">Data Related to this question will also be deleted !</p></small>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" id="close">Close</button>
                    <button type="button" class="btn btn-danger" id="ok_button">Yes</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')
<script src="/js/jquery.min.js"></script>
<script src="/js/jquery.dataTables.min.js"></script>
<script src="/js/dataTables.bootstrap4.min.js"></script>
<script src="/js/dataTables.buttons.min.js"></script>
<script src="/js/vfs_fonts.js"></script>
<script src="/js/buttons.html5.min.js"></script>

<script>
    jQuery(document).ready(function(){
        createTable();
        jQuery('#subject').change(function(){
            let subjectID = jQuery(this).val();
            jQuery.ajax({
                url:'getSubjectCategory',
                type:'post',
                data:'subjectID='+subjectID+'&_token={{ csrf_token() }}',
                success:function(result){
                    jQuery('#category').html(result)
                }
            });

            createTable();

        });
        jQuery('#category').change(function(){
            createTable();
        });

        /** 
         *  Create Datatable for question
         * 
         * */
        function createTable(){
            var table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                'bDestroy': true,
                ajax: "{{ route('get.question') }}?subject="+$('#subject').val()+"&category="+$('#category').val(),
                columns: [
                    {data: 'question', name: 'question'},
                    {data: 'action', name: 'action', orderable: false, searchable: false, width: "15%"},
                ]
            }); 
        }
        
    var id;
    $(document).on('click','.delete-data', function(){
        id = $(this).attr('data-id');
    });

    $(document).on('click','#ok_button', function () {             
            $.ajax({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				url: "/questionDelete/"+id,
                beforeSend: function () {
                    $('#ok_button').text('Deleting...');
                },
                type: 'DELETE',
                data: {
                    submit: true,
                    _token: $('input[name="_token"]').val()
                },
                success: function (data) {
                    console.log(data);

                    if(data.success == true){
                        setTimeout(function () {
                            $('#ok_button').text('Yes');
                            $('#close').trigger('click');
                            $('.dataTable').DataTable().ajax.reload();
                            toastr.success(data.message);
                        }, 1000);
                    }
                    else if(data.success == false){
                        setTimeout(function () {
                            $('#ok_button').text('Yes');
                            $('#close').trigger('click');
                            $('.dataTable').DataTable().ajax.reload();
                            toastr.error(data.message);
                        }, 1000);
                    }else{
                        setTimeout(function () {
                            $('#ok_button').text('Yes');
                            $('#close').trigger('click');
                            $('.dataTable').DataTable().ajax.reload();
                            toastr.info("Something went wrong!");
                        }, 1000);
                    }
                },
                error: function(){
                    toastr.error('Something Went Wrong, Try Again.');
                    $('#ok_button').text('Yes');
                }
            });
	    });

    });
</script>


@stop