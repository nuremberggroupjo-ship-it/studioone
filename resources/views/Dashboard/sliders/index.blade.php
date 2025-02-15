@extends('Dashboard.layouts.app')
@push('styles')
@endpush

@section('content')
    <div class="container">
        <div class="d-flex justify-content-end">
            <button class="btn btn-primary mb-3" id="add-slider-btn">Add Slider</button>
        </div>
        <div class="card">
            <div class="card-body">
                <table id="sliders-table" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Link</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    {{-- Include Modal --}}
    @include('Dashboard.sliders.modal')

    @push('scripts')
        <script>
            $(document).ready(function() {
                let table = $('#sliders-table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: '{{ route('admin.sliders.index') }}',
                    columns: [{
                            data: 'image',
                            name: 'image',
                            render: function(data) {
                                return `<img src="/storage/${data}" alt="Slider Image" style="width: 80px;height: 80px;object-fit: cover;">`;
                            }
                        }, {
                            data: 'title',
                            name: 'title'
                        },
                        {
                            data: 'description',
                            name: 'description'
                        },
                        {
                            data: 'button_link',
                            name: 'button_link'
                        },

                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false
                        }
                    ]
                });

                $('#add-slider-btn').click(function() {
                    $('#sliderModal').modal('show');
                    $('#sliderForm').trigger('reset');
                    $("#slider-title_header").text("Add Slider")

                    pond.removeFiles();
                });
                $('#sliderForm').submit(function(e) {
                    e.preventDefault();

                    let formData = new FormData(this);

                    $.ajax({
                        type: 'POST',
                        url: '{{ route('admin.sliders.store') }}',
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            $('#sliderModal').modal('hide');
                            table.ajax.reload();
                        },
                        error: function(response) {
                            if (response.status === 422) {
                                let errors = response.responseJSON.errors;

                                $('.error').remove();

                                $.each(errors, function(field, messages) {
                                    let errorMessage = messages.join('<br>');
                                    $(`[name="${field}"]`).after(
                                        `<div class="error text-danger">${errorMessage}</div>`
                                    );
                                if (field === 'image') {
                                    $('#image').after(
                                        `<div class="error text-danger">${errorMessage}</div>`
                                    );
                                }
                                });
                            } else {
                                alert('An unexpected error occurred.');
                            }
                        }
                    });
                });

                // Delete Slider
                $(document).on('click', '.delete-slider', function() {
                    let id = $(this).data('id');
                    if (confirm('Are you sure?')) {
                        $.ajax({
                            type: 'DELETE',
                            url: `{{ url('admin/sliders') }}/${id}`,
                            data: {
                                "_token": $('meta[name="csrf-token"]').attr("content")
                            },
                            success: function(response) {
                                table.ajax.reload();
                            }
                        });
                    }
                });
                $(document).on('click', '.edit-btn', function() {
                    $('#sliderForm').trigger('reset');
                    var id = $(this).data('id');
                    var title = $(this).data('title');
                    var title_ar = $(this).data('title_ar');
                    var description = $(this).data('description');
                    var description_ar = $(this).data('description_ar');
                    var button_name = $(this).data('button_name');
                    var button_name_ar = $(this).data('button_name_ar');
                    var button_link = $(this).data('button_link');
                    var image = $(this).data('image');


                    $("#slider-title_header").text("Edit Slider (" + title + ")")
                    $('#slider_id').val(id);
                    $('#slider-title').val(title);
                    $('#slider-title_ar').val(title_ar);
                    $('#slider-description').val(description);
                    $('#slider-description_ar').val(description_ar);
                    $('#slider-button_name').val(button_name);
                    $('#slider-button_name_ar').val(button_name_ar);
                    $('#slider-button_link').val(button_link);


                    var imageLink = location.origin + "/storage/" + image

                    pond.removeFiles();

                    pond.addFile(imageLink)
                    $('#sliderModal').modal('show');
                });

            });
            const inputElement = document.querySelector('#image');
            const pond = FilePond.create(inputElement, {
                allowMultiple: false,
                required: true,
                storeAsFile: true,
                credit: false,
                imagePreviewHeight: 170,
                allowImagePreview: true,
            });
        </script>
    @endpush
@endsection
