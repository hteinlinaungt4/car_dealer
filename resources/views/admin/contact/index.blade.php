@extends('admin.dashboard')
@section('title',"Contact")
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card mt-5 p-3 border-0">
                <div class="card-header">
                    <div class="card-title">
                        <h4>Contact Edit Form</h4>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{route('admin.contact.update',1)}}">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Address</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" rows="5" name="address" id="description">{{$contact->address}}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Email</label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control" name="email" value="{{$contact->email}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Phone</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="phone" value="{{$contact->phone}}">
                            </div>
                        </div>
                        <button class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')

     <script>
        $(document).ready(function() {

            @if (session('successmsg'))
                Swal.fire({
                    icon: 'success',
                    title: 'Success...',
                    text: '{{ session('successmsg') }}',
                });
            @endif
        });
    </script>
@endsection


