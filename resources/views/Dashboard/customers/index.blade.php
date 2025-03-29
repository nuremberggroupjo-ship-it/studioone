@extends('Dashboard.layouts.app')
@push('styles')
@endpush

@section('content')
    <div class="container">
        <div class="d-flex justify-content-end">
            <button class="btn btn-primary mb-3" id="add-customer-btn">Add Customer</button>
        </div>
        <div class="card">
            <div class="card-body">
                <table id="sliders-table" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Customer Name</th>
                            <th>Arabic Name</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($customers as $customer)
                            <tr>
                                <td><img src="{{ asset('images/' . $customer->image) }}" alt="Customer Image" class="img-fluid" style="width: 100px; height: 100px;"></td>
                                <td>{{ $customer->name }}</td>
                                <td>{{ $customer->arabic_name }}</td>
                                <td>
                                    <button class="btn btn-primary edit-customer-btn" data-customer-id="{{ $customer->id }}" data-customer-name="{{ $customer->name }}" data-customer-arabic-name="{{ $customer->arabic_name }}" data-customer-image="{{ $customer->image }}">Edit</button>
                                    <form action="{{ route('admin.customers.destroy', $customer->id) }}" method="POST" class="btn btn-danger">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="delete-customer-btn">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $customers->links() }}
            </div>
        </div>
    </div>
    @include('Dashboard.customers.create')
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const deleteButtons = document.querySelectorAll('.delete-customer-btn');
        deleteButtons.forEach(button => {
            button.addEventListener('click', function () {
                const form = this.closest('form');
                if (confirm('Are you sure you want to delete this customer?')) {
                    form.submit();
                }
            });
        });
    });
</script>
@endpush