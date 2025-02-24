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
                            return `<img src="/storage/${data}" alt="Post Image" style="width: 80px;height: 80px;object-fit: cover;">`;
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

                    $.ajax({
                        url: "{{ route('admin.posts.show', '') }}/" + id,
                        type: "GET",
                        dataType: "json",
                        success: function(response) {
                            if (response.success) {
                                let post = response.post;

                                $('#post_id').val(post.id);
                                $('#name').val(post.name);
                                $('#name_ar').val(post.name_ar);
                                $('#small_header').val(post.small_header);
                                $('#small_header_ar').val(post.small_header_ar);
                                $('#button_name').val(post.button_name);
                                $('#button_name_ar').val(post.button_name_ar);
                                $('#button_link').val(post.button_link);

                                $("#modal-title_post").text("Edit Post (" + post.name + ")");

                                FilePond.find(document.querySelector('#image_path')).removeFiles();
                                if (post.image_path) {
                                    FilePond.find(document.querySelector('#image_path')).addFile(
                                        location.origin + "/storage/" + post.image_path);
                                }

                                if (CKEDITOR.instances['description']) {
                                    CKEDITOR.instances['description'].setData(post.description);
                                }

                                if (CKEDITOR.instances['description_ar']) {
                                    CKEDITOR.instances['description_ar'].setData(post
                                        .description_ar);
                                }

                                $('#postModal').modal('show');
                            } else {
                                alert("Error: Unable to fetch post data.");
                            }
                        },
                        error: function(xhr) {
                            console.error(xhr.responseText);
                            alert("Failed to fetch post data.");
                        }
                    });
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
