@extends('user.master.layouts')
@section('title', 'Invoice')
@section('content')

<style>
    /* New Minimalist & Modern Invoice Styles - Modified Header & Payment */
    body {
        font-family: 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
        line-height: 1.6;
        color: #333;
        background-color: #f4f7f6; /* Very light subtle background */
    }
    .invoice-main-title {
    font-size: 2.2rem;
    font-weight: 600;
    color: #333;
    text-align: center;
    margin-bottom: 40px; /* Space below the title */
    padding-bottom: 15px;
    border-bottom: 3px solid #007bff; /* A strong accent line */
    display: block; /* Ensure it takes full width */
}

    /* Keeping the original header style for consistency with existing site design */
    .about-heading.header-text {
        background-position: center center;
        background-repeat: no-repeat;
        background-size: cover;
        padding: 100px 0; /* Adjust padding as needed */
        position: relative;
    }

    .about-heading.header-text::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.4); /* Dark overlay for text readability */
    }

    .about-heading.header-text .text-content {
        position: relative;
        z-index: 2;
        text-align: center;
        color: #fff;
    }

    .about-heading.header-text h2 {
        font-size: 3.5rem;
        font-weight: 700;
        margin-bottom: 0;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.5); /* Text shadow for better visibility */
    }


    .invoice-wrapper {
        max-width: 900px;
        margin: 50px auto; /* Adjust margin-top after header */
        background-color: #ffffff;
        padding: 40px 50px;
        border-radius: 6px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05); /* Very light, long shadow */
    }

    .invoice-header-info {
        display: flex;
        justify-content: space-between;
        margin-bottom: 30px;
        padding-bottom: 20px;
        border-bottom: 1px dashed #e0e0e0; /* Dashed line for subtle separation */
    }

    .invoice-header-info div {
        flex: 1;
    }

    .invoice-header-info .right-align {
        text-align: right;
    }

    .invoice-header-info strong {
        display: block;
        font-size: 1rem;
        color: #555;
        margin-bottom: 5px;
    }

    .invoice-header-info span {
        font-size: 1.2rem;
        font-weight: 500;
        color: #222;
    }

    .invoice-section {
        margin-bottom: 30px;
    }

    .invoice-section h4 {
        font-size: 1.3rem;
        font-weight: 600;
        color: #333;
        border-bottom: 2px solid #007bff; /* Accent line */
        padding-bottom: 8px;
        margin-bottom: 20px;
    }

    .item-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 15px;
    }

    .item-table th,
    .item-table td {
        padding: 15px 0;
        text-align: left;
        border-bottom: 1px solid #eee; /* Lighter border for items */
    }

    .item-table th {
        font-weight: 600;
        color: #555;
        background-color: #fcfcfc; /* Slightly different background for header */
    }

    .item-table td:last-child,
    .item-table th:last-child {
        text-align: right; /* Align amount to the right */
    }

    .item-table tbody tr:last-child td {
        border-bottom: none;
    }

    .total-section {
        text-align: right;
        margin-top: 30px;
        padding-top: 20px;
        border-top: 1px dashed #e0e0e0;
    }

    .total-section .total-label {
        font-size: 1.4rem;
        font-weight: 600;
        color: #333;
        display: inline-block;
        margin-right: 15px;
    }

    .total-section .total-amount {
        font-size: 2rem;
        font-weight: 700;
        color: #28a745; /* Prominent green for total */
        display: inline-block;
    }

    .admin-note {
        background-color: #eaf6ff; /* Light blue for note */
        border-left: 4px solid #007bff;
        padding: 20px;
        border-radius: 4px;
        margin-top: 40px;
        font-style: italic;
        color: #0056b3;
    }

    .invoice-footer {
        text-align: center;
        margin-top: 60px;
        padding-top: 30px;
        border-top: 1px solid #eee;
        color: #888;
        font-size: 0.85rem;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .invoice-wrapper {
            padding: 30px;
            margin: 0 20px 50px 20px;
        }
        .invoice-header-info {
            flex-direction: column;
            text-align: center;
        }
        .invoice-header-info .right-align {
            text-align: center;
            margin-top: 20px;
        }
    }
</style>

<div class="page-heading about-heading header-text"
     style="background-image: url({{ asset('user/assets/images/heading-6-1920x500.jpg') }});">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="text-content">
                    <h2>{{__('messages.invoice_detail')}}</h2>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="invoice-wrapper">
            <h3 class="invoice-main-title">{{__('messages.detail_purchase_invoice')}}</h3>
            <div class="invoice-header-info">

                <div>
                    <strong>{{__('messages.invoice_id')}}:</strong>
                    <span>{{$invoice->invoice_id}}</span>
                </div>
                <div class="right-align">
                    <strong>{{__('messages.date')}}:</strong>
                    <span>{{$invoice->confirmed_at}}</span>
                </div>
            </div>

            <div class="invoice-header-info">
                <div>
                    <strong>{{__('messages.billed_to')}}:</strong>
                    <span>{{$invoice->buyer_name}}</span> {{-- Replace with dynamic data: {{ $invoice->customer->name }} --}}
                </div>
                <div class="right-align">
                    <strong>{{__('messages.email')}}:</strong>
                    <span>{{$invoice->buyer_email}}</span> {{-- Replace with dynamic data: {{ $invoice->customer->email }} --}}
                </div>
            </div>

            <div class="invoice-section">
                <h4>{{__('messages.purchase_detail')}}</h4>
                <table class="item-table">
                    <thead>
                        <tr>
                            <th>{{__('messages.description')}}</th>
                            <th>{{__('messages.purchase_date')}}</th>
                            <th class="text-right">{{__('messages.amount')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <strong>{{$invoice->book->car->name}}</strong><br>
                                <small>{{$invoice->book->car->model}}</small>
                            </td>
                            @php
                                use Carbon\Carbon;
                            @endphp

                            <td>{{ Carbon::parse($invoice->confirmed_at)->format('d-m-Y') }}</td>

                            <td class="text-right">{{number_format($invoice->book->car->price, 0)}} (Lakh)</td> {{-- Replace with dynamic data: ${{ number_format($invoice->car_price, 2) }} --}}
                        </tr>
                        {{-- Add more items here if needed --}}
                    </tbody>
                </table>
            </div>

            <div class="invoice-section">
                <h4>{{__('messages.payment_summary')}}</h4>
                <div class="row">
                    <div class="col-md-6">
                        <strong>{{__('messages.payment_method')}}:</strong>
                        <p>{{ $invoice->payment_type}}</p> {{-- e.g., Visa, MasterCard --}}
                    </div>
                    <div class="col-md-6 text-md-right">
                        <strong>{{__('messages.payment_type')}}:</strong>
                        {{-- This is where you'll dynamically display the payment type --}}
                        <p>Cash-Down-Payment</p> {{-- e.g., 'Installment', 'One-time Payment', '6 Months Plan' --}}
                    </div>
                </div>
            </div>

            <div class="total-section">
                <span class="total-label">{{__('messages.grand_total')}}:</span>
                <span class="total-amount">{{number_format($invoice->book->car->price, 0)}} (Lakh)</span> {{-- Replace with dynamic data: ${{ number_format($invoice->total_amount, 2) }} --}}
            </div>

            <div class="admin-note">
                <p><strong>{{__('messages.note_for_admin')}}:</strong>{{__('messages.note_description')}}</p>
                {{-- Replace with dynamic data: <p><strong>Note from Admin:</strong> {{ $invoice->admin_reply }}</p> --}}
            </div>

        </div>
    </div>
</div>

@endsection
