<div class="modal fade" id="customerModal" tabindex="-1" role="dialog" aria-labelledby="customerModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="customerModalLabel">Add Customer</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="customerForm" enctype="multipart/form-data">
                @csrf
                <input type="hidden" id="customer-id" name="id">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="customer-name" class="form-label">Customer Name</label>
                        <input type="text" class="form-control form-control-solid" id="customer-name" name="name"
                            required>
                    </div>
                    <div class="mb-3">
                        <label for="customer-arabic-name" class="form-label">Arabic Name</label>
                        <input type="text" class="form-control form-control-solid" id="customer-arabic-name"
                            name="arabic_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="customer-image" class="form-label">Image</label>
                        <input type="file" class="form-control form-control-solid p-3" id="customer-image"
                            name="image" accept="image/*">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Customer</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#add-customer-btn').click(function() {
                $('#customerModal').modal('show');
                $('#customerForm').trigger('reset');
                $('#customerModalLabel').text('Add Customer');
                $('#customerForm').attr('action', '{{ route('admin.customers.store') }}');
            });

            $('.edit-customer-btn').click(function() {
                const customerId = $(this).data('customer-id');
                const customerName = $(this).data('customer-name');
                const customerArabicName = $(this).data('customer-arabic-name');
                const customerImage = $(this).data('customer-image');

                $('#customer-id').val(customerId);
                $('#customer-name').val(customerName);
                $('#customer-arabic-name').val(customerArabicName);


                $('#customerModalLabel').text('Edit Customer');
                $('#customerForm').attr('action', '{{ route('admin.customers.store') }}');

                $('#customerModal').modal('show');
            });

            $('#customerForm').submit(function(e) {
                e.preventDefault();

                let formData = new FormData(this);
                let actionUrl = $(this).attr('action');
                let method = 'POST';

                $.ajax({
                    type: method,
                    url: actionUrl,
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        $('#customerModal').modal('hide');
                        window.location.reload();
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
                                    $('#customer-image').after(
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
        });
    </script>
@endpush
