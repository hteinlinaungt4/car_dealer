@extends('admin.dashboard')
@section('title',"About")
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card mt-5 p-3 border-0">
                <div class="card-header">
                    <div class="card-title">
                        <h4>{{__('messages.admin_about_edit')}}</h4>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{route('admin.about.update',1)}}">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">{{__('messages.admin_description')}}</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" rows="10" name="description" id="description">{{$about->description}}</textarea>
                            </div>
                        </div>
                        <button class="btn btn-primary">{{__('messages.admin_update')}}</button>
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


