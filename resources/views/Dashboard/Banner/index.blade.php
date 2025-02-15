@extends('Dashboard.layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-end">
            <button class="btn btn-primary mb-3">Add Slider</button>
        </div>
        <div class="card">
            <div class="card-body">
                <table id="sliders-table" class="table table-row-bordered gy-5">
                    <thead>
                        <tr class="fw-semibold fs-6 text-muted">
                            <th>Title</th>
                            <th>Description</th>
                            <th>Link</th>
                            <th>Image</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
    @push('scripts')
        <script>
            $(document).ready(function() {
                $('#sliders-table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: '{{ route('sliders.index') }}',
                    columns: [{
                            data: 'translations[0].title',
                            name: 'title'
                        },
                        {
                            data: 'translations[0].description',
                            name: 'description'
                        },
                        {
                            data: 'link',
                            name: 'link'
                        },
                        {
                            data: 'image_path',
                            name: 'image',
                            render: function(data) {
                                return `<img src="${data}" alt="Slider Image" style="width: 100px;">`;
                            }
                        },
                        {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row) {
                            return `<a href="#" class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions 
                                        <i class="ki-outline ki-down fs-5 ms-1"></i></a>`;
                        }
                        }
                    ]
                });
            });
        </script>
    @endpush
@endsection
