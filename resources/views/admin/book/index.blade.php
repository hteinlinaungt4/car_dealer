@extends('admin.dashboard')
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
                                    <th>Car Name</th>
                                    <th>User Name</th>
                                    <th>User Email</th>
                                    <th>User Phone</th>
                                    <th>User Message</th>
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
                ajax: 'ssd/book',
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

            // $(document).on('change', '.status-select', function(e) {
            //     e.preventDefault();
            //     var id = $(this).data('id');
            //     var status = $(this).val();
            //     var car_id = $(this).data('car_id');
            //     var url = `/book/${id}/status`;

            //     // AJAX call to update the status
            //     $.ajax({
            //         url: url,
            //         type: 'POST',
            //         data: {
            //             _token: '{{ csrf_token() }}',
            //             status: status,
            //             car_id: car_id
            //         },
            //         success: function(response) {
            //             table.ajax.reload(null, false); // Reload table without resetting pagination
            //             Swal.fire(
            //                 'Updated!',
            //                 'Status has been updated.',
            //                 'success'
            //             );
            //         },
            //         error: function(xhr) {
            //             console.error(xhr.responseText);
            //             Swal.fire(
            //                 'Error!',
            //                 'There was an error updating the status.',
            //                 'error'
            //             );
            //         }
            //     });
            // });

            $(document).on('change', '.status-select', function(e) {
    e.preventDefault();

    var id = $(this).data('id');
    var car_id = $(this).data('car_id');
    var status = $(this).val();
    var url = `/book/${id}/status`;

    // If the status is "Confirm Request", show date picker
    if (status === 'confirmed') {
        Swal.fire({
            title: 'Select Testing Driving Date',
            input: 'date',
            inputLabel: 'Choose a date',
            inputAttributes: {
                min: new Date().toISOString().split('T')[0] // Optional: prevent past dates
            },
            showCancelButton: true,
            confirmButtonText: 'Confirm',
            cancelButtonText: 'Cancel',
            inputValidator: (value) => {
                if (!value) {
                    return 'Please select a date!';
                }
            }
        }).then((result) => {
            if (result.isConfirmed) {
                var testing_date = result.value;

                // AJAX call after confirming date
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        status: status,
                        car_id: car_id,
                        testing_date: testing_date // include selected date
                    },
                    success: function(response) {
                        table.ajax.reload(null, false); // Reload table without resetting pagination
                        Swal.fire(
                            'Updated!',
                            'Status and test drive date have been updated.',
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
            }
        });
    } else {
        // For all other statuses, just make the AJAX request directly
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
    }
});


        });
    </script>
@endsection
