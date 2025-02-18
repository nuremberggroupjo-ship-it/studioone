@extends('Dashboard.layouts.app')

@push('styles')
    <script src="http://cdnjs.cloudflare.com/ajax/libs/ckeditor/4.0.1/ckeditor.js"></script>
    <style>
        .ck.ck-editor {
            z-index: 99999 !important;
        }

        .ck.ck-reset {
            z-index: 99999 !important;
        }

        .ck.ck-balloon-panel {
            z-index: 99999 !important;
        }
    </style>
@endpush

@section('content')
    <div class="container">
        <div class="d-flex justify-content-end">
            <button class="btn btn-primary mb-3" id="add-post_btn" data-bs-toggle="modal" data-bs-target="#postModal">Add
                Post</button>
        </div>
        <div class="card">
            <div class="card-body">
                <table id="posts-table" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Slug</th>
                            <th>Description</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    @include('Dashboard.posts.modal')

    @push('scripts')
        <script>
            $(document).ready(function() {
                $('.text-editor').each(function() {
                    if (!CKEDITOR.instances[this.name]) {
                        CKEDITOR.replace(this.name);
                    }
                });
                var table = $('#posts-table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: '{{ route('admin.posts.index') }}',
                    columns: [{
                        data: 'image_path',
                        name: 'image_path',
                        render: function(data) {
                            return `<img src="${data}" alt="Post Image" style="width: 80px;height: 80px;object-fit: cover;">`;
                        }
                    }, {
                        data: 'name',
                        name: 'name'
                    }, {
                        data: 'slug',
                        name: 'slug'
                    }, {
                        data: 'description',
                        name: 'description',
                        render: function(data, type, row) {
                            return data.length > 180 ? data.substring(0, 170) + '...' : data;
                        }
                    }, {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }]
                });

                $('#postForm').submit(function(e) {
                    e.preventDefault();

                    for (instance in CKEDITOR.instances) {
                        CKEDITOR.instances[instance].updateElement();
                    }

                    let formData = new FormData(this);

                    $('.error-message').remove();
                    $('.is-invalid').removeClass('is-invalid');

                    $.ajax({
                        type: 'POST',
                        url: '{{ route('admin.posts.store') }}',
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            $('#postModal').modal('hide');
                            $('#postForm')[0].reset();
                            table.ajax.reload();
                            toastr.success(response.message);
                        },
                        error: function(response) {
                            if (response.status === 422) {
                                let errors = response.responseJSON.errors;
                                $.each(errors, function(key, messages) {
                                    let inputField = $('[name="' + key + '"]');
                                    inputField.addClass('is-invalid');
                                    inputField.after(
                                        '<div class="text-danger error-message">' +
                                        messages[0] + '</div>');
                                });
                            } else {
                                alert('An unexpected error occurred.');
                            }
                        }
                    });
                });
                $(document).on('click', '.edit-btn', function() {
                    $('#postForm')[0].reset();

                    let id = $(this).data('id');
                    let name = $(this).data('name');
                    let name_ar = $(this).data('name_ar');
                    let small_header = $(this).data('small_header');
                    let small_header_ar = $(this).data('small_header_ar');
                    let short_description = $(this).data('short_description');
                    let short_description_ar = $(this).data('short_description_ar');
                    let button_name = $(this).data('button_name');
                    let button_name_ar = $(this).data('button_name_ar');
                    let button_link = $(this).data('button_link');
                    let description = $(this).data('description');
                    let description_ar = $(this).data('description_ar');
                    let image = $(this).data('image');

                    $('#post_id').val(id);
                    $('#name').val(name);
                    $('#name_ar').val(name_ar);
                    $('#small_header').val(small_header);
                    $('#small_header_ar').val(small_header_ar);
                    $('#button_name').val(button_name);
                    $('#button_name_ar').val(button_name_ar);
                    $('#button_link').val(button_link);

                    $("#modal-title_post").text("Edit Post (" + name + ")");

                    FilePond.find(document.querySelector('#image_path'))
                        .removeFiles();
                    if (image) {
                        FilePond.find(document.querySelector('#image_path')).addFile(
                            image);
                    }

                    $('#postModal').modal('show');

                    CKEDITOR.instances['description'].setData(description);
                    CKEDITOR.instances['description_ar'].setData(
                        description_ar);
                });

                const inputElement = document.querySelector('#image_path');
                const pond = FilePond.create(inputElement, {
                    allowMultiple: false,
                    required: true,
                    storeAsFile: true,
                    credit: false,
                    imagePreviewHeight: 170,
                    allowImagePreview: true,
                });

                $(document).on('click', '.delete-btn', function() {
                    let id = $(this).data('id');
                    let row = $(this).closest('tr');

                    if (confirm('Are you sure you want to delete this service?')) {
                        $.ajax({
                            url: '{{ route('admin.posts.destroy', '') }}/' + id,
                            type: 'DELETE',
                            data: {
                                _token: '{{ csrf_token() }}',
                            },
                            success: function(response) {
                                table.ajax.reload();
                            },
                            error: function(response) {
                                alert('Error occurred. Please try again.');
                            }
                        });
                    }
                });

            });
        </script>
    @endpush
@endsection
