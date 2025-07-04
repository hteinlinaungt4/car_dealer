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
                                    <th>Invoice Id</th>
                                    <th>Sales Person</th>
                                    <th>Buyer Name</th>
                                    <th>Buyer Email</th>
                                    <th>Total Amount</th>
                                    <th>Confirmed_at</th>
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
                ajax: '/invoices/ssd',
                columns: [
                    {
                        data: 'invoice_id',
                        name: 'invoice_id',
                    },
                    {
                        data: 'salesperson_name',
                        name: 'salesperson_name'
                    },
                    {
                        data: 'buyer_name',
                        name: 'buyer_name'
                    },
                    {
                        data: 'buyer_email',
                        name: 'buyer_email'
                    },
                    {
                        data: 'total_amount',
                        name: 'total_amount'
                    },
                    {
                        data: 'confirmed_at',
                        name: 'confirmed_at'
                    },

                ],

            });


        });
    </script>
@endsection
