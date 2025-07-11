{{-- @extends('admin.dashboard')
@section('title', 'User Lists')
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card mt-5 p-3 border-0">
                    <div class="card-body">
                        <table class="table table-bordered text-center w-100 display nowrap" id="usertable">
                            <thead>
                                <tr>
                                    <th>User Name</th>
                                    <th>User Email</th>
                                    <th>User Phone</th>
                                    <th>Car Name</th>
                                    <th>Total Amount</th>
                                    <th>Posting Date</th>
                                    <th class="nosort">Actions</th>
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
    <script>
        $(document).ready(function() {

            function updateSelectDisabling() {
                $('.status-select').each(function() {
                    var status = $(this).val();
                    if (status === 'pending') {
                        $(this).prop('disabled', false);
                    } else {
                        $(this).prop('disabled', true);
                    }
                });
            }

            var table = $('#usertable').DataTable({
                mark: true,
                responsive: true,
                processing: true,
                serverSide: true,
                ajax: '/process/ssd',
                columns: [{
                        data: 'car_id',
                        name: 'car_id'
                    },
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
                        data: 'message',
                        name: 'message'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
                    },
                    {
                        data: 'actions',
                        name: 'actions',
                        class: 'text-center',
                        orderable: false
                    }
                ],
                drawCallback: function() {
                    updateSelectDisabling(); // Call after every draw
                }
            });

            updateSelectDisabling(); // Initial call

            @if (session('successmsg'))
                Swal.fire({
                    icon: 'success',
                    title: 'Success...',
                    text: '{{ session('successmsg') }}',
                });
            @endif

            $(document).on('change', '.status-select', function(e) {
                e.preventDefault();
                var id = $(this).data('id');
                var status = $(this).val();
                var car_id = $(this).data('car_id');
                var url = `/book/${id}/status`;

                // AJAX call to update the status
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        status: status,
                        car_id: car_id
                    },
                    success: function(response) {
                        table.ajax.reload(null, false); // Reload table without resetting pagination
                        Swal.fire(
                            'Updated!',
                            'Status has been updated.',
                            'success'
                        );
                    },
                    error: function(xhr) {
                        console.error(xhr.responseText);
                        Swal.fire(
                            'Error!',
                            'There was an error updating the status.',
                            'error'
                        );
                    }
                });
            });

        });
    </script>
@endsection --}}
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
                               book_id : bookingId
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
