@extends('admin.dashboard')
@section('title',"Category")
@section('count')
@endsection
@section('content')
   <div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h2>User Account Lists</h2>
        <span class="fs-3 float-end fw-bold">Total: {{ count($users) }}</span>
    </div>
    <div class="card-body">
        @if (session('success'))
            <div id="success-message" style="display: none;">{{ session('success') }}</div>
        @endif

        <table class="table table-data2  table-striped table-hover table-bordered">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Role</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr class="tr-shadow">
                    <td class="col-2">
                        @if($user->photo)
                            <div class="hide">
                                <img alt="hello" width="100px" height="80px" style="object-fit: cover" src="{{ asset('storage/profile/'.$user->photo)}}">
                            </div>
                        @else
                        <div id="select">
                            <img width="100px" height="80px" style="object-fit: cover" src="{{ asset('storage/default.png')}}" alt="">
                        </div>
                        @endif
                    </td>
                    <td>
                        <input hidden type="text" id="userid" value="{{ $user->id }}">
                        {{$user ->name}}
                    </td>
                    <td>
                        {{ $user->email }}
                    </td>
                    <td>
                        {{ $user->address }}
                    </td>
                    <td>
                        <div class="table-data-feature d-flex">
                            <select name="" class="form-control status me-3">
                                <option value="admin" @if($user->role == 'admin') selected  @endif>Admin</option>
                                <option value="user"  @if($user->role == 'user') selected  @endif>User</option>
                            </select>
                            <a href="{{ route('user#delete',$user->id) }}" class="btn btn-danger btn-sm ml-1" onclick="return confirm('Are you sure you want to delete this category?')">Delete</a>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
   </div>
@endsection
@section('script')
    <script>
            $(document).ready(function(){
                window.addEventListener('DOMContentLoaded', () => {
            const successMessage = document.getElementById('success-message');

            if (successMessage) {
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: successMessage.innerText,
                });
            }
            });

            $('.status').change(function(){
                $role=$(this).val();
                $node=$(this).parents("tr");
                $id=$node.find('#userid').val();
                $data={
                    'userid' : $id,
                    'role' : $role,
                }
                $.ajax({
                    type : 'get',
                    datatype: 'json',
                    url :'ajaxrolechange',
                    data : $data,
                    success : function(response){
                        if(response.message == 'success'){
                            window.location.href = "userlist";
                        }
                    }

                })
            })
        })
    </script>
@endsection
