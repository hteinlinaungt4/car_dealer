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
                                    <th>User</th>
                                    <th>Car</th>
                                    <th>User Message</th>
                                    <th>Reply</th>
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


            var table = $('#usertable').DataTable({
                mark: true,
                responsive: true,
                processing: true,
                serverSide: true,
                ajax: '/inquiries/ssd',
                columns: [
                    {
                        data: 'user_id',
                        name: 'user_id',
                    },
                    {
                        data: 'car_id',
                        name: 'car_id'
                    },

                    {
                        data: 'message',
                        name: 'message'
                    },
                    {
                        data: 'reply',
                        name: 'reply'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        class: 'text-center',
                        orderable: false
                    }
                ],

            });


            @if (session('successmsg'))
                Swal.fire({
                    icon: 'success',
                    title: 'Success...',
                    text: '{{ session('successmsg') }}',
                });
            @endif

            $(document).on('click', '.reply', function(e) {
                e.preventDefault();
                var url = $(this).data('url');
                Swal.fire({
                    title: 'Reply to Inquiry',
                    input: 'textarea',
                    inputPlaceholder: 'Type your reply here...',
                    showCancelButton: true,
                    confirmButtonText: 'Send Reply',
                    preConfirm: (reply) => {
                        if (!reply) {
                            Swal.showValidationMessage('Please enter a reply');
                        } else {
                            $.ajax({
                                url: url,
                                method: 'POST',
                                data: {
                                    reply: reply,
                                    _token: '{{ csrf_token() }}'
                                },
                                success: function(response) {
                                    Swal.fire('Success!', 'Your reply has been sent.', 'success');
                                    table.ajax.reload();
                                },
                                error: function() {
                                    Swal.fire('Error!', 'There was an error sending your reply.', 'error');
                                }
                            });
                        }
                    }
                });
            });



        });
    </script>
@endsection
