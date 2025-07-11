@extends('admin.dashboard')
@section('title',"Company Edit")
@section('content')
<div class="card">
    <div class="card-header">
        <h2>{{ __('messages.admin_company_edit')}}</h2>
    </div>
    <div class="card-body">
        <form action="{{route('company.update',$company->id)}}" class="w-50 mx-auto" method="POST" enctype="multipart/form-data">
            @method('PUT')
            @csrf

            <div class="form-group">
                <label for="">{{__('messages.admin_company_name')}}</label>
                <input type="text"  value="{{$company->name}}" class="form-control @error('name') is-invalid @enderror" name="name" >
                @error ('name')
                    <div class="invalid-feedback">{{$message}}</div>
                @enderror
            </div>
            <div class="form-group">
                <img class="object-cover" src="{{asset('storage/company/'.$company->image)}}" width="200px" height="200px" alt="">
                <br>
                <label for="">{{ __('messages.admin_company_logo')}}</label>
                <input type="file" class="form-control @error('image') is-invalid @enderror" name="image" >
                @error ('image')
                    <div class="invalid-feedback">{{$message}}</div>
                @enderror
            </div>
            <button class="btn btn-primary float-right">{{ __('messages.admin_update')}}</button>
        </form>
    </div>
   </div>
@endsection
