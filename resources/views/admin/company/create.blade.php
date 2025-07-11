@extends('admin.dashboard')
@section('title',"Company Create")
@section('content')
<div class="card">
    <div class="card-header">
        <h2>{{ __('messages.admin_company')}}</h2>
    </div>
    <div class="card-body">
        <form action="{{route('company.store')}}" class="w-50 mx-auto" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="">{{ __('messages.admin_company_name')}}</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="{{ __('messages.admin_enter_company')}}" value="{{old('name')}}">
                @error ('name')
                    <div class="invalid-feedback">{{$message}}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="">{{ __('messages.admin_company_logo')}}</label>
                <input type="file" class="form-control @error('image') is-invalid @enderror" name="image" >
                @error ('image')
                    <div class="invalid-feedback">{{$message}}</div>
                @enderror
            </div>
            <button class="btn btn-primary float-right">{{ __('messages.admin_create')}}</button>
        </form>
    </div>
   </div>
@endsection
