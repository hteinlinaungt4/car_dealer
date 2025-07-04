@extends('user.master.layouts')
@section('title', 'Booking History') {{-- Changed title to be more specific --}}
@section('content')

<style>
    /* Inherit/Adapt styles from your detailed invoice/inquiry list for consistency */
    body {
        font-family: 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
        line-height: 1.6;
        color: #333;
        background-color: #f4f7f6; /* Very light subtle background */
    }

    .list-main-title { /* Re-use for the list title (generic for lists) */
        font-size: 2.2rem;
        font-weight: 600;
        color: #333;
        text-align: center;
        margin-bottom: 40px;
        padding-bottom: 15px;
        border-bottom: 3px solid #007bff;
        display: block;
    }

    /* Header text style from your original design */
    .page-heading.about-heading.header-text {
        background-position: center center;
        background-repeat: no-repeat;
        background-size: cover;
        padding: 100px 0;
        position: relative;
    }

    .page-heading.about-heading.header-text::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.4);
    }

    .page-heading.about-heading.header-text .text-content {
        position: relative;
        z-index: 2;
        text-align: center;
        color: #fff;
    }

    .page-heading.about-heading.header-text h2 {
        font-size: 3.5rem;
        font-weight: 700;
        margin-bottom: 0;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
    }

    /* Container for the list */
    .booking-list-wrapper {
        max-width: 1100px; /* Wider to accommodate more columns if needed */
        margin: 50px auto;
        background-color: #ffffff;
        padding: 40px 50px;
        border-radius: 6px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
    }

    /* Table styles for the booking list */
    .booking-list-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 25px;
    }

    .booking-list-table th,
    .booking-list-table td {
        padding: 15px 18px; /* Padding for readability */
        text-align: left;
        border-bottom: 1px solid #eee;
    }

    .booking-list-table th {
        font-weight: 600;
        color: #555;
        background-color: #fcfcfc;
        text-transform: uppercase;
        font-size: 0.95rem;
    }

    .booking-list-table tbody tr:hover {
        background-color: #f9f9f9; /* Subtle hover effect */
    }

    .booking-list-table td {
        font-size: 1.05rem;
        color: #333;
    }

    /* Column Widths */
    .booking-list-table th:nth-child(1), .booking-list-table td:nth-child(1) { width: 10%; } /* Booking ID */
    .booking-list-table th:nth-child(2), .booking-list-table td:nth-child(2) { width: 15%; } /* Date */
    .booking-list-table th:nth-child(3), .booking-list-table td:nth-child(3) { width: 18%; } /* Customer Name */
    .booking-list-table th:nth-child(4), .booking-list-table td:nth-child(4) { width: 18%; } /* Car */
    .booking-list-table th:nth-child(5), .booking-list-table td:nth-child(5) { width: 15%; } /* Message (excerpt) */
    .booking-list-table th:nth-child(6), .booking-list-table td:nth-child(6) { width: 12%; text-align: center; } /* Status */
    .booking-list-table th:nth-child(7), .booking-list-table td:nth-child(7) { width: 12%; text-align: center; } /* Actions */


    /* Status Badges */
    .status-badge {
        display: inline-block;
        padding: 6px 10px;
        border-radius: 4px;
        font-size: 0.85rem;
        font-weight: 600;
        text-transform: capitalize;
        color: #fff;
    }

    .status-badge.pending {
        background-color: #ffc107; /* Yellow */
        color: #333;
    }
    .status-badge.confirmed {
        background-color: #28a745; /* Green */
    }
    .status-badge.rejected {
        background-color: #dc3545; /* Red */
    }

    .view-detail-link {
        color: #007bff;
        text-decoration: none;
        font-weight: 500;
        display: inline-block; /* For better padding/margin control */
        padding: 5px 10px;
        border-radius: 4px;
        transition: background-color 0.2s ease;
    }

    .view-detail-link:hover {
        text-decoration: underline;
        background-color: #e9f5ff; /* Light blue background on hover */
    }

    /* Pagination styles */
    .pagination-container {
        margin-top: 30px;
        display: flex;
        justify-content: center;
    }

    /* Responsive adjustments */
    @media (max-width: 992px) { /* Adjust for medium screens */
        .booking-list-wrapper {
            padding: 30px;
            margin: 0 20px 50px 20px;
        }
        .booking-list-table th,
        .booking-list-table td {
            padding: 12px 15px;
            font-size: 1rem;
        }
        /* Hide customer email/phone or message on smaller screens if too wide */
        .booking-list-table th:nth-child(3), .booking-list-table td:nth-child(3) { width: 22%; } /* Customer Name gets more space */
        .booking-list-table th:nth-child(4), .booking-list-table td:nth-child(4) { width: 22%; } /* Car gets more space */
        .booking-list-table th:nth-child(5), .booking-list-table td:nth-child(5) { display: none; } /* Hide Message excerpt */
    }

    @media (max-width: 768px) {
        .booking-list-wrapper {
            padding: 20px;
            margin: 0 15px 50px 15px;
        }
        .booking-list-table th,
        .booking-list-table td {
            padding: 10px 12px;
            font-size: 0.9rem;
        }
        /* Hide more columns on small screens */
        .booking-list-table th:nth-child(3), .booking-list-table td:nth-child(3) { display: none; } /* Hide Customer Name */
        .booking-list-table th:nth-child(1), .booking-list-table td:nth-child(1) { width: 25%; } /* Booking ID gets more space */
        .booking-list-table th:nth-child(2), .booking-list-table td:nth-child(2) { width: 30%; } /* Date gets more space */
        .booking-list-table th:nth-child(4), .booking-list-table td:nth-child(4) { width: 25%; } /* Car gets more space */
        .booking-list-table th:nth-child(6), .booking-list-table td:nth-child(6) { width: 20%; } /* Status gets more space */
        .booking-list-table th:nth-child(7), .booking-list-table td:nth-child(7) { width: auto; } /* Action adjusts */
    }

    @media (max-width: 480px) {
        .booking-list-table th:nth-child(2), .booking-list-table td:nth-child(2) { display: none; } /* Hide Date on very small */
        .booking-list-table th:nth-child(1), .booking-list-table td:nth-child(1) { width: 35%; } /* Booking ID gets more space */
        .booking-list-table th:nth-child(4), .booking-list-table td:nth-child(4) { width: 35%; } /* Car gets more space */
        .booking-list-table th:nth-child(6), .booking-list-table td:nth-child(6) { width: auto; } /* Status gets more space */
        .booking-list-table th:nth-child(7), .booking-list-table td:nth-child(7) { width: auto; } /* Action adjusts */
    }

</style>

<div class="page-heading about-heading header-text"
     style="background-image: url({{ asset('user/assets/images/heading-6-1920x500.jpg') }});">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="text-content">
                    <h2>{{__('messages.booking_history')}}</h2>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="booking-list-wrapper">
            <h3 class="list-main-title">{{__('messages.your_recent_car_bookings')}}</h3>

            @if($bookings->isEmpty())
                <div class="alert alert-info text-center" role="alert">
                    {{__('messages.no_bookings')}}
                    <a href="{{ route('user.car.list') }}" class="alert-link">{{__('messages.browse_car')}}</a>
                </div>
            @else
                <table class="booking-list-table">
                    <thead>
                        <tr>
                            <th>{{__('messages.date')}}</th>
                            <th>{{__('messages.customer_name')}}</th>
                            <th>{{__('messages.car')}}</th>
                            <th>{{__('messages.message')}}</th> {{-- A brief excerpt --}}
                            <th>{{__('messages.driving_test')}}</th>
                            <th class="text-center">{{__('messages.status')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($bookings as $booking)
                            <tr>
                                <td>{{ \Carbon\Carbon::parse($booking->created_at)->format('d M Y') }}</td>
                                <td>{{ $booking->name }}</td>
                                <td>
                                    @if ($booking->car)
                                        {{ $booking->car->name }} <small class="text-muted">({{ $booking->car->model }})</small>
                                    @else
                                        N/A
                                    @endif
                                </td>
                                <td>
                                    {{ Str::limit($booking->message, 40) }} {{-- Use Str::limit for a short preview --}}
                                </td>
                                <td>{{ $booking->driving_date ? \Carbon\Carbon::parse($booking->driving_date)->format('d M Y') : 'N/A' }}</td>
                                <td class="text-center">
                                    <span class="status-badge {{ $booking->status }}">
                                        {{ $booking->status }}
                                    </span>
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>


            @endif



        </div>
    </div>
</div>

@endsection
