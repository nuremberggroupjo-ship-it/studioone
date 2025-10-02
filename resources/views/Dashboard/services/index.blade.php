@extends('Dashboard.layouts.app')
@push('styles')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ckeditor/4.0.1/ckeditor.js"></script>
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
            <button class="btn btn-primary mb-3" id="add-service_btn" data-bs-toggle="modal" data-bs-target="#serviceModal">Add
                Service</button>
        </div>
        <div class="card">
            <div class="card-body">
                <table id="services-table" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Short Description</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    @include('Dashboard.services.modal')

    @push('scripts')
        <script>
            $(document).ready(function() {
                $('.text-editor').each(function() {
                    if (!CKEDITOR.instances[this.name]) {
                        CKEDITOR.replace(this.name);
                    }
                });



                var table = $('#services-table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: '{{ route('admin.services.index') }}',
                    columns: [{
                            data: 'image',
                            name: 'image',
                            render: function(data) {
                                return `<img src="/storage/${data}" alt="Services Image" style="width: 80px;height: 80px;object-fit: cover;">`;
                            }
                        }, {
                            data: 'name',
                            name: 'name'
                        },
                        {
                            data: 'short_description',
                            name: 'short_description'
                        },

                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false
                        }
                    ]
                });

                $('#serviceForm').submit(function(e) {
                    e.preventDefault();

                    for (instance in CKEDITOR.instances) {
                        CKEDITOR.instances[instance].updateElement();
                    }

                    let formData = new FormData(this);

                    $('.error-message').remove();
                    $('.is-invalid').removeClass('is-invalid');

                    $.ajax({
                        type: 'POST',
                        url: '{{ route('admin.services.store') }}',
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            $('#serviceModal').modal('hide');
                            $('#serviceForm')[0].reset();
                            table.ajax.reload();
                            var serviceId = $("#service_id").val()
                            if (serviceId) {
                                toastr.success('Service Edited successfully!');
                            } else {
                                toastr.success('Service added successfully!');
                            }
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

                const inputElement = document.querySelector('#image');
                const pond = FilePond.create(inputElement, {
                    allowMultiple: false,
                    required: true,
                    storeAsFile: true,
                    credit: false,
                    imagePreviewHeight: 170,
                    allowImagePreview: true,
                });
                $('#add-service_btn').click(function() {
                    $('#serviceModal').modal('show');
                      $('#service_id').val(''); // ✅ Clear the hidden ID to force create mode
                    $('#serviceModal').trigger('reset');
                    
                    $("#modal-title_service").text("Add Slider")

                      // Clear CKEditor content
                        CKEDITOR.instances['service_description'].setData('');
                        CKEDITOR.instances['service_description_ar'].setData('');

                    pond.removeFiles();
                });
                $(document).on('click', '.edit-btn', function() {
                    $('#serviceForm')[0].reset();

                    let serviceId = $(this).data('id');

                    $.ajax({
                        url: "{{ route('admin.services.show', '') }}/" +
                            serviceId,
                        type: "GET",
                        dataType: "json",
                        success: function(response) {
                            if (response.success) {
                                let service = response.service;

                                $('#service_id').val(service.id);
                                $('#service_name').val(service.name);
                                $("#modal-title_service").text("Edit Service (" + service.name +
                                    ")");

                                $('#service_name_ar').val(service.name_ar);
                                $('#service_short_description').val(service.short_description);
                                $('#service_short_description_ar').val(service
                                    .short_description_ar);

                                CKEDITOR.instances['service_description'].setData(service
                                    .description);
                                CKEDITOR.instances['service_description_ar'].setData(service
                                    .description_ar);

                                FilePond.find(document.querySelector('#image')).removeFiles();
                                if (service.image) {
                                    FilePond.find(document.querySelector('#image')).addFile(service
                                        .image);
                                }

                                $('#serviceModal').modal('show');
                            } else {
                                alert("Error fetching service details.");
                            }
                        },
                        error: function(xhr, status, error) {
                            console.log(xhr.responseText);
                            alert("Failed to fetch service details.");
                        }
                    });
                });

                $(document).on('click', '.delete-btn', function() {
                    let id = $(this).data('id');
                    let row = $(this).closest('tr');

                    if (confirm('Are you sure you want to delete this service?')) {
                        $.ajax({
                            url: '{{ route('admin.services.destroy', '') }}/' + id,
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

            })
        </script>
    @endpush
@endsection
