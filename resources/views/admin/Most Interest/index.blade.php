@extends('admin.dashboard')
@section('title',"Most Interest")
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card mt-5 p-3 border-0">

                <div class="card-body">
                    <table class="table table-bordered text-center w-100 display nowrap"  id="usertable" >
                        <thead>
                            <th>{{__('messages.admin_image')}}</th>
                            <th>{{__('messages.admin_name')}}</th>
                            <th>{{__('messages.admin_company')}}</th>
                            <th>{{__('messages.admin_price')}}</th>
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
            var table=$('#usertable').DataTable({
                mark:true,
                responsive: true,
                processing: true,
                serverSide: true,
                ajax: '/ssd/most',
                columns: [
                    {
                        data: 'image',
                        name: 'image'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'company',
                        name: 'company'
                    },
                    {
                        data: 'price',
                        name: 'price'
                    },

                ],
                columnDefs: [{
                    orderable: false,
                    targets: 'nosort'
                },
            ],
            });
        });
    </script>
@endsection
