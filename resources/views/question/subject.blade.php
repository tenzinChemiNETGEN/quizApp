@extends('layouts.app')

@section('content')
{{-- create subject --}}
<div class="card">
    <div class="card-body">
        {{-- <h4 class="card-title">Add Questions</h4> --}}
        <div class="container">
            <form action="{{ route('subject.store') }}" method="POST" enctype="multipart/form-data">
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


                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>

{{-- edit subject --}}
<div class="card">
    <div class="card-body">
        @if (!$subjects==null)
        <table class="table data-table">
            <thead>
                <tr>
                    <th>Subject Image</th>
                    <th>Subject Name</th>
                    <th width="280px">Action</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
        @else
            <h1>Create Subject</h1>
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
                Are you sure you want to delete this user?
                <small><p class="text-danger">Data Related to this user will also be deleted !</p></small>
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
<script src="/js/jquery.dataTables.min.js"></script>

<script src="/js/dataTables.bootstrap4.min.js"></script>

<script src="/js/dataTables.buttons.min.js"></script>

<script src="/js/vfs_fonts.js"></script>

<script src="/js/buttons.html5.min.js"></script>

<script type="text/javascript">
   
    $(function () { 
    var table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('subject.create') }}",
        columns: [
            {data:'image', name:'image',orderable: false, searchable: false,},
            {data: 'subject', name: 'subject'},
            {data: 'action', name: 'action', orderable: false, searchable: false, width: "15%"},
      ]
    });

    var id;
    $(document).on('click','.delete-data', function(){
        id = $(this).attr('data-id');
    });

    $(document).on('click','#ok_button', function () {             
            $.ajax({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				url: "/delete/"+id,
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