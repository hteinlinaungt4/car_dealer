@extends('user.master.layouts')
@section('title', 'Car Lists')
@section('content')


    <div class="page-heading about-heading header-text"
        style="background-image: url({{ asset('user/assets/images/heading-6-1920x500.jpg') }});">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="text-content">
                        <h2>{{ __('messages.change_password')}}</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-3 offset-8">
                    </div>
                </div>
                <div class="col-lg-6 offset-3">
                    <div class="card mt-5">
                        <div class="card-body">
                            <form action="{{ route('userpassword#change') }}" method="post" novalidate="novalidate">
                                @csrf
                                <div class="form-group mb-3 ">
                                    <label for="cc-payment" class="control-label mb-1">{{ __('messages.old_password')}}</label>
                                    <input id="cc-pament" value="" name="oldpassword" type="password" class="form-control @error('oldpassword') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Old password ..">
                                    @error('oldpassword')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label for="cc-payment" class="control-label mb-1">{{ __('messages.new_password')}}</label>
                                    <input id="cc-pament" value="" name="newpassword" type="password" class="form-control @error('newpassword') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="New password ..">
                                    @error('newpassword')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label for="cc-payment" class="control-label mb-1">{{ __('messages.confirm_password')}}</label>
                                    <input id="cc-pament" value="" name="comfirmpassword" type="password" class="form-control @error('comfirmpassword') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Comfirm password ..">
                                    @error('comfirmpassword')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                @enderror
                                </div>

                                <div>
                                    <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block w-100 my-3">
                                        <span id="payment-button-amount">{{ __('messages.change_password')}}</span>
                                        <span id="payment-button-sending" style="display:none;">Sending…</span>
                                        <i class="fa-solid fa-circle-right"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection
