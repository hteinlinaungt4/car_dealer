@extends('user.master.layouts')
@section('title', 'Inquiry List')
@section('content')

<style>
    /* Inherit header styles from your existing design */
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
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
    }

    /* --- New Styles for Inquiry List Cards --- */
    body {
        font-family: 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
        line-height: 1.6;
        color: #333;
        background-color: #f4f7f6; /* Consistent background */
    }

    .inquiry-list-container {
        max-width: 900px; /* Max width for content area */
        margin: 50px auto; /* Centered with vertical spacing */
        padding: 0 15px; /* Padding for smaller screens */
    }

    .inquiry-card {
        background-color: #ffffff;
        border-radius: 8px; /* Slightly more rounded corners */
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08); /* Soft shadow */
        margin-bottom: 25px; /* Space between cards */
        padding: 25px;
        border: 1px solid #e0e0e0; /* Subtle border */
        transition: transform 0.2s ease, box-shadow 0.2s ease; /* Smooth hover effect */
    }

    .inquiry-card:hover {
        transform: translateY(-5px); /* Lift effect on hover */
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.12); /* Enhanced shadow on hover */
    }

    .inquiry-card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 15px;
        padding-bottom: 10px;
        border-bottom: 1px solid #f0f0f0; /* Separator for header */
    }

    .inquiry-card-header h4 {
        margin: 0;
        font-size: 1.5rem;
        color: #007bff; /* Accent color for car name */
        font-weight: 600;
    }

    .inquiry-card-header .inquiry-date {
        font-size: 0.95rem;
        color: #888;
    }

    .inquiry-details p {
        margin-bottom: 8px;
        line-height: 1.5;
        font-size: 1rem;
    }

    .inquiry-details strong {
        color: #555;
        display: inline-block; /* Ensure strong is block-level for better spacing */
        min-width: 120px; /* Align text vertically */
    }

    /* --- MODIFIED: Styles for Admin Reply Status --- */
    .admin-reply-status {
        margin-top: 15px;
        padding: 8px 12px; /* Slightly more padding for a better 'tag' look */
        border-radius: 5px;
        font-weight: 500;
        font-size: 1.05rem; /* Increased font size for readability */
        display: inline-block; /* Ensures padding and background work correctly */
    }

    .admin-reply-status.text-success {
        background-color: #e6ffe6; /* Light green background */
        border: 1px solid #28a745;
        color: #28a745;
    }

    .admin-reply-status.text-warning {
        background-color: #fffacd; /* Light yellow background */
        border: 1px solid #ffc107;
        color: #ffc107;
    }

    .inquiry-actions {
        margin-top: 20px;
        padding-top: 15px;
        border-top: 1px dashed #f0f0f0;
        text-align: right; /* Align button to the right */
    }

    .delete_btn {
        background-color: #dc3545; /* Red for delete/cancel */
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
        font-size: 0.95rem;
        transition: background-color 0.2s ease;
    }

    .delete_btn:hover {
        background-color: #c82333;
    }

    /* General text alignment utilities for flexibility */
    .text-right { text-align: right; }
    .text-center { text-align: center; }

    /* For pagination (if you add it later) */
    .pagination-container {
        margin-top: 30px;
        display: flex;
        justify-content: center;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .inquiry-card {
            padding: 20px;
        }
        .inquiry-card-header {
            flex-direction: column;
            align-items: flex-start;
        }
        .inquiry-card-header h4 {
            margin-bottom: 5px;
            font-size: 1.3rem;
        }
        .inquiry-details strong {
            min-width: 90px; /* Adjust for smaller screens */
        }
        .admin-reply-status {
            font-size: 0.95rem; /* Slightly smaller on small screens if needed */
        }
        .inquiry-actions {
            text-align: center;
        }
    }
</style>

<div class="page-heading about-heading header-text"
     style="background-image: url({{ asset('user/assets/images/heading-6-1920x500.jpg') }});">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="text-content">
                    <h2>{{__('messages.your_inquiries')}}</h2>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="inquiry-list-container">
            <h3 class="page-main-title text-center mb-4">{{__('messages.your_recent_car_inquires')}}</h3>

            @if($inquiries->isEmpty())
                <div class="alert alert-info text-center" role="alert">
                    {{__('messages.no_inquire')}}
                    <a href="" class="alert-link">{{__('messages.browse_car_inquire')}}</a>
                </div>
            @else
                @foreach ($inquiries as $inquiry)
                    <div class="inquiry-card">
                        <div class="inquiry-card-header">
                            <h4>{{ $inquiry->car->name ?? 'N/A Car' }}</h4>
                            <span class="inquiry-date">
                                {{__('messages.inquired_on')}}: {{ \Carbon\Carbon::parse($inquiry->created_at)->format('d M Y, h:i A') }}
                            </span>
                        </div>
                        <div class="inquiry-details">
                            <p><strong>{{__('messages.your_message')}}:</strong> {{ $inquiry->message }}</p>
                            <p>
                                <strong>{{__('messages.admin_reply')}}:</strong>
                                @if ($inquiry->reply)
                                    <span class="admin-reply-status text-success">{{ $inquiry->reply }}</span>
                                @else
                                    <span class="admin-reply-status text-warning">{{__('messages.no_reply_yet')}}</span>
                                @endif
                            </p>
                        </div>

                    </div>
                @endforeach


            @endif
        </div>
    </div>
</div>

@endsection

