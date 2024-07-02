@extends('admin.dashboard')
@section('title',"Company Edit")
@section('content')
<div class="card">
    <div class="card-header">
        <h2>Company Edit</h2>
    </div>
    <div class="card-body">
        <form action="{{route('company.update',$company->id)}}" class="w-50 mx-auto" method="POST" enctype="multipart/form-data">
            @method('PUT')
            @csrf

            <div class="form-group">
                <label for="">Company Name</label>
                <input type="text"  value="{{$company->name}}" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Enter Company Name ...">
                @error ('name')
                    <div class="invalid-feedback">{{$message}}</div>
                @enderror
            </div>
            <div class="form-group">
                <img class="object-cover" src="{{asset('storage/company/'.$company->image)}}" width="200px" height="200px" alt="">
                <br>
                <label for="">Company Logo</label>
                <input type="file" class="form-control @error('image') is-invalid @enderror" name="image" >
                @error ('image')
                    <div class="invalid-feedback">{{$message}}</div>
                @enderror
            </div>
            <button class="btn btn-primary float-right">Create</button>
        </form>
    </div>
   </div>
@endsection
