@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div>

@include('partials.image')
@include('partials.error')
{{-- @include('partials.success') --}}
@include('partials.spinner')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Data Provider Module</div>

                <div class="card-body">
                    <div class="d-grid gap-2 d-md-block">
                        <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#addProviderModal">Add</button>
                    </div>
                    <br>
                    <table class="table" id="providersTable">
                        <thead class="table-light">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Provider</th>
                                <th scope="col">URL</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($providers)
                                @foreach ($providers as $item)
                                <tr>
                                    <th scope="row">{{ $item->id }}</th>
                                    <td id="name_{{ $item->id }}">{{ $item->name }}</td>
                                    <td id="url_{{ $item->id }}">{{ $item->url }}</td>
                                    <td>
                                        <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                            <input type="hidden" name="provId" value="{{ $item->id }}">
                                            <button type="button" class="btn btn-success viewClassBtn" value={{ $item->url }}>View</button>
                                            <button type="button" class="btn btn-warning editClassBtn" value={{ $item->id }}>Edit</button>
                                            <button type="button" class="btn btn-danger deleteModal" value={{ $item->id }}>Delete</button>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            @else
                                <tr>
                                    NO records found!
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

</div>
@include('modals.add')
@endsection

@section('scripts')
<script>
// view
$('.viewClassBtn').on('click', function(){
    var url = $(this).val();
    // console.log('url:' + url);
    if (url !== '') {
        $.ajax({
            type: "GET",
            url: url,
            beforeSend: function() {},
            success: function(data) {
                var imageUrl = data.message;
                $("#imageDisp").attr("src",imageUrl);
                $("#imageCont").show();
            },
            error: function(response){
                console.log('error');
                let imageUrl = 'https://i.picsum.photos/id/1/5616/3744.jpg?hmac=kKHwwU8s46oNettHKwJ24qOlIAsWN9d2TtsXDoCWWsQ'; // set as default img
                $("#imageDisp").attr("src",imageUrl);
                $("#imageCont").show();
		    }
        })
    }
});

// add
$('#save-prov').on('click', function(){
    var url = $(this).val();
    // console.log(url);
    let name = $("input[name=name]").val();
    let urlName = $("input[name=url]").val();
    let _token = $('meta[name="csrf-token"]').attr('content');

    $.ajax({
		type: "POST",
		url: "/provider",
        data:{
          name:name,
          url:urlName,
          _token: _token
        },
        beforeSend: function() {
            $('#addProviderModal').modal('hide');
            $(".spinnerForm").show();
        },
		success: function(response){
            location.reload();
		},
		error: function(response, status, xhr){
            // console.log(response);
            $('#addProviderModal').modal('hide');
            $(".errorMsg").text(response.responseJSON.message);
            $("#error").show();
		}
	});
});

//delete
$('.deleteModal').on('click', function(e){
    var id = $(this).val();
    $('#deleteProviderModal').modal('show');
    $('#deleteId').val(id);
});


$('#delete-prov').on('click', function(){
    var id = $("input[name=id]").val();
    console.log('id:' + id);

    let _token = $('meta[name="csrf-token"]').attr('content');

    $.ajax({
		type: "DELETE",
		url: "/provider/"+id,
        data:{
          id:id,
          _token: _token
        },
        beforeSend: function() {
            $('#deleteProviderModal').modal('hide');
            $(".spinnerForm").show();
        },
		success: function(response){
			if(response) {
                console.log(response.message);
                // $('.success').text(response.success);
                $("#deleteForm")[0].reset();
                $('#deleteProviderModal').modal('hide');

                location.reload();
            }
            $('.sucessMsg').text(response.message);
            $("#success").show().fadeIn("slow");
		},
		error: function(response){
            // console.log(response);
            $('#deleteProviderModal').modal('hide');
            $(".errorMsg").text(response.responseJSON.message);
            $("#error").show();
		}
	});
});

//edit
$('.editClassBtn').on('click', function(e){
    let id = $(this).val();
    // console.log(id);

    let name= $('#name_'+id).text();
	let url= $('#url_'+id).text();

    $('#edit-id').val(id);

    $('#edit-url').val(url);
    $('#edit-name').val(name);
    $('#editProviderModal').modal('show');

});

$('#edit-prov').on('click', function(){
    let id = $("input[name=edit_id]").val();
    let url = $("input[name=edited_url]").val();
    let name = $("input[name=edited_name]").val();
    let _token = $('meta[name="csrf-token"]').attr('content');

    $.ajax({
		type: "PUT",
		url: "/provider/"+id,
        data:{
          name:name,
          url:url,
          _token: _token
        },
        beforeSend: function() {
            $('#editProviderModal').modal('hide');
            $(".spinnerForm").show();
        },
		success: function(response){
            location.reload();
		},
		error: function(response){
            $('#editProviderModal').modal('hide');
            $(".errorMsg").text(response.responseJSON.message);
            $("#error").show();
            $(".spinnerForm").hide();
		}
	});
});
</script>
@endsection