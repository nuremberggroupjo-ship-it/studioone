@extends('Dashboard.layouts.app')

@push('styles')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ckeditor/4.0.1/ckeditor.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet">

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
            <button class="btn btn-primary mb-3" id="add-project_btn" data-bs-toggle="modal" data-bs-target="#projectModal">
                Add Project
            </button>
        </div>
        <div class="card">
            <div class="card-body">
                <table id="projects-table" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Title</th>
                            <th>Categories</th>
                            <th>Is Recent</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    @include('Dashboard.projects.modal')

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

        <script>
            $(document).ready(function() {
                $('.text-editor').each(function() {
                    let editorId = $(this).attr('id');
                    if (!CKEDITOR.instances[editorId]) {
                        CKEDITOR.replace(editorId);
                    }
                });
                $('.select2').select2({
                    placeholder: "Select Categories",
                    allowClear: true
                });

                var table = $('#projects-table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: '{{ route('admin.projects.index') }}',
                    columns: [{
                            data: 'primary_image',
                            name: 'primary_image',
                            render: function(data) {
                                if (data && data.image_path) {
                                    return `<img src="/storage/${data.image_path}" width="100" height="80" style="object-fit: cover;">`;
                                }
                                return '';
                            }
                        },

                        {
                            data: 'title',
                            name: 'title'
                        },
                        {
                            data: 'categories',
                            name: 'categories',
                            render: function(data) {
                                // If categories are passed as a string or array, process them
                                if (typeof data === 'string') {
                                    // If it's a string (perhaps comma-separated), split it
                                    return data.split(',').join(', ');
                                }
                                if (Array.isArray(data)) {
                                    // If it's already an array of category names, join them
                                    return data.join(', ');
                                }
                                return 'No Categories'; // Return 'No Categories' if no categories are found
                            }
                        },
                        {
                            data: 'is_recent',
                            name: 'is_recent',
                            render: function(data) {
                                return data ? 'Yes' : 'No';
                            }
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false
                        }
                    ]
                });


                $('#projectForm').submit(function(e) {
                    e.preventDefault();

                    for (instance in CKEDITOR.instances) {
                        CKEDITOR.instances[instance].updateElement();
                    }

                    let formData = new FormData(this);

                    $('.error-message').remove();
                    $('.is-invalid').removeClass('is-invalid');

                    $.ajax({
                        type: 'POST',
                        url: '{{ route('admin.projects.store') }}',
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            $('#projectModal').modal('hide');
                            $('#projectForm')[0].reset();
                            table.ajax.reload();
                            toastr.success('Project saved successfully!');
                        },
                        error: function(response) {
                            if (response.status === 422) {
                                let errors = response.responseJSON.errors;
                                $.each(errors, function(key, messages) {
                                    let inputField = $('[name="' + key + '"]');
                                    inputField.addClass('is-invalid');
                                    inputField.after(
                                        '<div class="text-danger error-message">' +
                                        messages[0] + '</div>'
                                    );
                                });
                            } else {
                                alert('An unexpected error occurred.');
                            }
                        }
                    });
                });

                const image = document.querySelector('#image');
                const images = document.querySelector('#images');

                const pond = FilePond.create(image, {
                    allowMultiple: false,
                    required: true,
                    storeAsFile: true,
                    credit: false,
                    imagePreviewHeight: 170,
                    allowImagePreview: true,
                });

                const pondImages = FilePond.create(images, {
                    required: false,
                    storeAsFile: true,
                    credit: false,
                    allowMultiple: true,
                    imagePreviewHeight: 170,
                    allowImagePreview: true,
                });
                $('#add-project_btn').click(function() {
                    $('#projectModal').modal('show');
                    $('#projectForm')[0].reset();
                    $("#modal-title_project").text("Add Project");
                    pond.removeFiles();
                    pondImages.removeFiles()
                });
                $(document).on('click', '.edit-btn', function() {
                    $('#projectForm')[0].reset();

                    let id = $(this).data('id');

                    $.ajax({
                        url: "{{ route('admin.projects.show', '') }}/" + id, // Ensure the route exists
                        type: "GET",
                        dataType: "json",
                        success: function(response) {
                            if (response.success) {
                                let project = response.project;

                                $('#project_id').val(project.id);
                                $('#project_title').val(project.title);
                                $('#project_title_ar').val(project.title_ar);
                                $('#project_is_recent').prop('checked', project.is_recent);

                                let categories = project.categories;
                                if (typeof categories === 'string') {
                                    categories = categories.includes(',') ? categories.split(',')
                                        .map(item => item.trim()) : [categories];
                                } else if (typeof categories === 'number') {
                                    categories = [categories.toString()];
                                } else if (!Array.isArray(categories)) {
                                    categories = [];
                                }

                                let categorySelect = $('#project_categories');
                                categorySelect.val(categories).trigger('change');

                                $("#modal-title_project").text("Edit Project (" + project.title +
                                    ")");

                                pond.removeFiles();
                                pondImages.removeFiles();

                                if (project.primary_image) {
                                    FilePond.find(document.querySelector('#image')).addFile(location
                                        .origin + "/storage/" + project.primary_image);
                                }

                                if (project.images && Array.isArray(project.images)) {
                                    project.images.forEach(function(img) {
                                        if (img) {
                                            FilePond.find(document.querySelector('#images'))
                                                .addFile(location.origin + "/storage/" +
                                                    img);
                                        }
                                    });
                                }

                                $('#projectModal').modal('show');

                                if (CKEDITOR.instances['project_description']) {
                                    CKEDITOR.instances['project_description'].setData(project
                                        .description);
                                }

                                if (CKEDITOR.instances['project_description_ar']) {
                                    CKEDITOR.instances['project_description_ar'].setData(project
                                        .description_ar);
                                }
                            } else {
                                alert("Error: Unable to fetch project data.");
                            }
                        },
                        error: function(xhr) {
                            console.error(xhr.responseText);
                            alert("Failed to fetch project data.");
                        }
                    });
                });


                $(document).on('click', '.delete-btn', function() {
                    let id = $(this).data('id');
                    let row = $(this).closest('tr');

                    if (confirm('Are you sure you want to delete this project?')) {
                        $.ajax({
                            url: '{{ route('admin.projects.destroy', '') }}/' + id,
                            type: 'DELETE',
                            data: {
                                _token: '{{ csrf_token() }}',
                            },
                            success: function(response) {
                                table.ajax.reload();
                                toastr.success('Project deleted successfully!');
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
