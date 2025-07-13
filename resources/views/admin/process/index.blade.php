
@extends('admin.dashboard')
@section('title', 'User Lists') {{-- Keeping original title as per request --}}
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card mt-5 p-3 border-0">
                    <div class="card-body">
                        <table class="table table-bordered text-center w-100 display nowrap" id="usertable">
                            <thead>
                                <tr>
                                    <th>{{ __('messages.admin_name')}}</th>
                                    <th>{{__('messages.admin_email')}}</th>
                                    <th>{{__('messages.admin_phone')}}</th>
                                    <th>{{__('messages.admin_car_model')}}</th>
                                    <th>{{__('messages.admin_total_amount')}}</th>
                                    <th>{{ __('messages.admin_payment_type')}}</th>
                                    <th>{{__('messages.admin_posting')}}</th>
                                    <th class="nosort">{{__('messages.admin_action')}}</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> {{-- Make sure SweetAlert2 is included --}}
    <script>
        $(document).ready(function() {

            // The `updateSelectDisabling` function is no longer needed
            // as we are replacing the select dropdown with a button/status text.

            var table = $('#usertable').DataTable({
                mark: true,
                responsive: true,
                processing: true,
                serverSide: true,
                ajax: '/process/ssd',
                columns: [

                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'phone',
                        name: 'phone'
                    },
                    {
                        data: 'car_id',
                        name: 'car_id',

                    },
                    {
                        data: 'amount',
                        name: 'amount',
                    },
                    {
                        data: 'payment_type',
                        name : 'payment_type',
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
                    },
                    {
                        data: 'actions',
                        name: 'actions',
                        class: 'text-center',
                        orderable: false,
                        searchable: false
                    }
                ],

            });

            @if (session('successmsg'))
                Swal.fire({
                    icon: 'success',
                    title: 'Succs...',
                    text: '{{ session('successmsg') }}',
                });
            @endif



            $(document).on('click', '.confirm-booking-btn', function() {
                var bookingId = $(this).data('id');
    var selectedPaymentType = $('select[name="payment_type"][data-id="' + bookingId + '"]').val();
                Swal.fire({
                    title: 'Are you sure you want to confirm this Payment?',
                    text: "This action will set the Payment status to 'Confirmed'!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#28a745', // Green for confirm
                    cancelButtonColor: '#d33',   // Red for cancel
                    confirmButtonText: 'Yes, Payment Confirmed!',
                    cancelButtonText: 'No, Keep Pending'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: `/confirm`, // Your backend route for confirmation
                            method: 'POST', // Use POST for state changes
                            data: {
                                _token: '{{ csrf_token() }}', // Laravel CSRF token
                               book_id : bookingId,
                                payment_type: selectedPaymentType // Send the selected payment type
                            },
                            success: function(response) {
                                if (response.success) {
                                    Swal.fire(
                                        'Payment Confirmed!',
                                        response.message || 'The Payment Confirmation has been successfully confirmed.',
                                        'success'
                                    ).then(() => {
                                        // Reload DataTables to reflect the status change
                                        table.ajax.reload(null, false);
                                    });
                                } else {
                                    Swal.fire(
                                        'Error!',
                                        response.message || 'Failed to confirm the booking.',
                                        'error'
                                    );
                                }
                            },
                            error: function(xhr) {
                                var errorMsg = 'An error occurred while communicating with the server.';
                                if (xhr.responseJSON && xhr.responseJSON.message) {
                                    errorMsg = xhr.responseJSON.message;
                                }
                                Swal.fire(
                                    'Error!',
                                    errorMsg,
                                    'error'
                                );
                                console.error('AJAX error:', xhr.responseText);
                            }
                        });
                    }
                });
            });



        });
    </script>
@endsection
