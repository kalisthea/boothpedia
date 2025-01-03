<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">
    <script src="{{ asset('script.js') }}"></script>  
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style-admin.css') }}">
    <title>Booking Invoices</title>
</head>
<body>
    <!-- Side Bar -->
    @include('sidebar')

    <!-- Content -->
    <div class="container">
        <!-- Header -->
        <div class="header">
            <div class="header-name">
                <h1>Booking Invoices</h1>
            </div>
            @include('navheader')
        </div>

        <!-- Booking Invoices -->
        <div class="booking-content" style="margin-bottom:70px">
            <div class="booth-detail">
                <div class="booth-detail-content">
                    <h2 style="margin-bottom:30px;">{{ $event->name }}</h2>
                    <p style="margin-bottom:30px;"><strong>Occupied Booths : </strong>{{ $totalQty }}</p>
                    <p style="margin-bottom:30px;"><strong>Total Sales : </strong>Rp {{ number_format($totalSales, 2, ',', '.') }}</p>
                </div>
            </div>
            <table class="invoice-table">
                <thead>  
                    <tr style="padding-bottom:5px;">  
                        <th>Tenant Name</th>  
                        <th>Qty</th>  
                        <th>Booked Booth</th>  
                        <th>Category</th> 
                        <th>Total</th>  
                        <th>Booking Date</th>  
                    </tr>  
                </thead>  
                <tbody>  
                    @foreach ($invoices as $invoice)  
                        <tr>  
                            <td>{{ $invoice->tenant->name}}</td> 
                            <td>{{ $invoice->quantity }}</td>
                            <td>  
                                @foreach ($invoice->booths as $booth)  
                                    {{ $booth->booth_name }}<br>  
                                @endforeach  
                            </td>
                            <td>  
                                @foreach ($invoice->booths as $booth)  
                                    {{ $booth->category->category_name }}<br>  
                                @endforeach  
                            </td>
                            <td>Rp {{ number_format($invoice->total_price, 2, ',', '.') }}</td>
                            <td>{{ \Carbon\Carbon::parse($invoice->created_at)->format('d-m-Y') }}</td>
                        </tr>  
                    @endforeach  
                </tbody>
            </table>
        </div>
        <div class="back-button-container">  
            <a href="{{ url('eventdetail/'.$event->name) }}" class="back-button">Back</a>  
        </div>
    </div>
    
</body>
</html>