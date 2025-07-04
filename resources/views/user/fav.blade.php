@extends('user.master.layouts')
@section('title', 'Car Lists')
@section('content')


    <div class="page-heading about-heading header-text"
        style="background-image: url({{ asset('user/assets/images/heading-6-1920x500.jpg') }});">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="text-content">
                        <h2>{{ __('messages.favorite')}}</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>



    @foreach ($fav as $f)
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
                                <div class="row">
                                    <div class="col-md-4">
                                        <a href="{{ route('car.detail', $f->id) }}">
                                            <img class=" object-cover" width="100%" height="200px"
                                                src="{{ asset('storage/cars/' . $f->image1) }}" alt="img">
                                        </a>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="left-content">
                                            <h6>{{__('messages.model')}}</h6>
                                            <p>{{ $f->name }}</p>
                                            <h6>{{__('messages.color')}}</h6>
                                            <p>{{ $f->body_color }}</p>
                                            <h6>{{__('messages.steering_position')}}</h6>
                                            <p>{{ $f->position }}</p>
                                            <h6>{{__('messages.price')}}</h6>
                                            <p>{{ $f->price }} (Lakh)</p>
                                        </div>
                                        <button data-id="{{ $f->id }}"
                                            class="btn btn-danger btn-sm mt-3 delete_btn">{{__('messages.remove_favourite')}}</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection

@section('script')
    <script>
        $(document).on('click', '.delete_btn', function(e) {
            e.preventDefault();
            var id = $(this).data('id');
            Swal.fire({
                title: 'Are you sure you want to Cancel Book?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                            method: "GET",
                            url: `favdelete/${id}`,
                        })
                        .done(function(msg) {
                            Swal.fire(
                                'Canceled!',
                                'Your are successfully Cancel Book.',
                                'success'
                            ).then(() => {
                                location.reload(); // Reload the page
                            });
                        });

                }
            })
        })
    </script>
@endsection
