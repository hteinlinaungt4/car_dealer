@extends('user.master.layouts')
@section('title', 'Invoice List')
@section('content')

<style>
    /* Inherit/Adapt styles from your detailed invoice for consistency */
    body {
        font-family: 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
        line-height: 1.6;
        color: #333;
        background-color: #f4f7f6; /* Very light subtle background */
    }

    .invoice-main-title { /* Re-use for the list title */
        font-size: 2.2rem;
        font-weight: 600;
        color: #333;
        text-align: center;
        margin-bottom: 40px;
        padding-bottom: 15px;
        border-bottom: 3px solid #007bff;
        display: block;
    }

    /* Header text style from your original invoice */
    .about-heading.header-text {
        background-position: center center;
        background-repeat: no-repeat;
        background-size: cover;
        padding: 100px 0;
        position: relative;
    }

    .about-heading.header-text::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.4);
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
        text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
    }

    /* Container for the list */
    .invoice-list-wrapper {
        max-width: 1000px; /* Slightly wider than detail for more columns */
        margin: 50px auto;
        background-color: #ffffff;
        padding: 40px 50px;
        border-radius: 6px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
    }

    /* Table styles for the invoice list */
    .invoice-list-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 25px;
    }

    .invoice-list-table th,
    .invoice-list-table td {
        padding: 15px 20px; /* More padding for readability */
        text-align: left;
        border-bottom: 1px solid #eee;
    }

    .invoice-list-table th {
        font-weight: 600;
        color: #555;
        background-color: #fcfcfc;
        text-transform: uppercase; /* Make headers slightly stand out */
        font-size: 0.95rem;
    }

    /* --- NEW/MODIFIED: Column Widths for Spacing --- */
    .invoice-list-table th:nth-child(1), /* Invoice ID */
    .invoice-list-table td:nth-child(1) {
        width: 15%; /* Give it a bit more space */
    }
    .invoice-list-table th:nth-child(2), /* Date */
    .invoice-list-table td:nth-child(2) {
        width: 15%; /* Explicit width for Date */
    }
    .invoice-list-table th:nth-child(3), /* Buyer Name */
    .invoice-list-table td:nth-child(3) {
        width: 20%;
    }
    .invoice-list-table th:nth-child(4), /* Vehicle */
    .invoice-list-table td:nth-child(4) {
        width: 25%; /* Give Vehicle more space */
    }
    .invoice-list-table th:nth-child(5), /* Total Amount */
    .invoice-list-table td:nth-child(5) {
        width: 15%; /* Adjust Total Amount to fit */
        text-align: right;
    }
    .invoice-list-table th:nth-child(6), /* Action */
    .invoice-list-table td:nth-child(6) {
        width: 10%; /* Space for the View Detail link */
        text-align: center; /* Center the link */
    }

    .invoice-list-table td {
        font-size: 1.05rem;
        color: #333;
    }

    .invoice-list-table .view-detail-link {
        color: #007bff;
        text-decoration: none;
        font-weight: 500;
    }

    .invoice-list-table .view-detail-link:hover {
        text-decoration: underline;
    }

    /* Pagination styles */
    .pagination-container {
        margin-top: 30px;
        display: flex;
        justify-content: center;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .invoice-list-wrapper {
            padding: 20px;
            margin: 0 15px 50px 15px;
        }
        .invoice-list-table th,
        .invoice-list-table td {
            padding: 10px 15px;
            font-size: 0.9rem;
        }
        /* Hide columns on small screens. Adjusted based on new column widths. */
        .invoice-list-table th:nth-child(3),
        .invoice-list-table td:nth-child(3), /* Buyer Name */
        .invoice-list-table th:nth-child(4) small, /* Hide small text in Vehicle */
        .invoice-list-table td:nth-child(4) small {
            display: none;
        }
    }

    /* Further adjust column widths for smaller screens */
    @media (max-width: 768px) {
        .invoice-list-table th:nth-child(1), /* Invoice ID */
        .invoice-list-table td:nth-child(1) {
            width: 25%;
        }
        .invoice-list-table th:nth-child(2), /* Date */
        .invoice-list-table td:nth-child(2) {
            width: 30%;
        }
        .invoice-list-table th:nth-child(4), /* Vehicle (main part) */
        .invoice-list-table td:nth-child(4) {
            width: 25%; /* Still need space for main vehicle name */
        }
        .invoice-list-table th:nth-child(5), /* Total Amount */
        .invoice-list-table td:nth-child(5) {
            width: 20%;
        }
        .invoice-list-table th:nth-child(6), /* Action */
        .invoice-list-table td:nth-child(6) {
            width: 10%;
        }
    }

    @media (max-width: 480px) {
        /* Even smaller screens, simplify further if needed */
        .invoice-list-table th:nth-child(2), /* Hide Date on very small screens */
        .invoice-list-table td:nth-child(2) {
            display: none;
        }
        .invoice-list-table th:nth-child(1), /* Invoice ID */
        .invoice-list-table td:nth-child(1) {
            width: 30%;
        }
        .invoice-list-table th:nth-child(4), /* Vehicle */
        .invoice-list-table td:nth-child(4) {
            width: 40%;
        }
        .invoice-list-table th:nth-child(5), /* Total Amount */
        .invoice-list-table td:nth-child(5) {
            width: 30%;
        }
        .invoice-list-table th:nth-child(6), /* Action */
        .invoice-list-table td:nth-child(6) {
            width: auto; /* Let it take remaining space */
        }
    }

</style>

<div class="page-heading about-heading header-text"
     style="background-image: url({{ asset('user/assets/images/heading-6-1920x500.jpg') }});">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="text-content">
                    <h2>{{__('messages.your_invoices')}}</h2>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="invoice-list-wrapper">
            <h3 class="invoice-main-title">{{__('messages.all_purchase_invoices')}}</h3>

            @if($invoices->isEmpty())
                <div class="alert alert-info text-center" role="alert">
                    You currently have no invoices to display.
                </div>
            @else
                <table class="invoice-list-table">
                    <thead>
                        <tr>
                            <th>{{__('messages.invoice_id')}}</th>
                            <th>{{__('messages.date')}}</th>
                            <th>{{__('messages.buyer_name')}}</th>
                            <th>{{__('messages.vehicle')}}</th>
                            <th class="text-right">{{__('messages.total_amount')}}</th>
                            <th class="text-center"></th> {{-- For View button, align center --}}
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($invoices as $invoice)
                            <tr>
                                <td><strong>#{{ $invoice->invoice_id }}</strong></td>
                                <td>{{ \Carbon\Carbon::parse($invoice->confirmed_at)->format('d M Y') }}</td>
                                <td>{{ $invoice->buyer_name }}</td>
                                <td>
                                    @if ($invoice->book && $invoice->book->car)
                                        {{ $invoice->book->car->name }}
                                        <small class="text-muted">({{ $invoice->book->car->model }})</small>
                                    @else
                                        N/A
                                    @endif
                                </td>
                                <td class="text-right">
                                    @if ($invoice->book && $invoice->book->car)
                                        {{ number_format($invoice->book->car->price, 0) }} (Lakh)
                                    @else
                                        0 (Lakh)
                                    @endif
                                </td>
                                <td class="text-center">
                                    {{-- Assuming you have a route to view individual invoice details --}}
                                    <a href="{{ route('user.invoices.detail', $invoice->invoice_id) }}" class="view-detail-link">{{__('messages.view_detail')}}</a>
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
