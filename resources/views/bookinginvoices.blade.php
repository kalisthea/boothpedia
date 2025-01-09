<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">
    <script src="{{ asset('script.js') }}"></script>  
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style-admin.css') }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>  
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script> 
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
                    <h2 style="margin-bottom:30px;"><strong>Total Sales : </strong>Rp {{ number_format($totalSales, 2, ',', '.') }}</h2>
                </div>
            </div>

            <!-- Filter Section -->  
            <div class="filter-section">  
                <form method="GET" action="{{ route('invoice') }}" class="form-inline">  
                    <div class="form-group">  
                        <select id="event_name" name="event_name" class="form-control">  
                            <option value="">Select Event</option>  
                            @foreach ($events as $event)  
                                <option value="{{ $event->id }}" {{ request('event_name') == $event->id ? 'selected' : '' }}>  
                                    {{ $event->name }}  
                                </option>  
                            @endforeach  
                        </select>  
                    </div>  

                    <div class="form-group">  
                        <select id="month" name="month" class="form-control">  
                            <option value="">Select Month</option>  
                            @foreach (range(1, 12) as $month)  
                                <option value="{{ $month }}" {{ request('month') == $month ? 'selected' : '' }}>  
                                    {{ \Carbon\Carbon::create()->month($month)->format('F') }}  
                                </option>  
                            @endforeach  
                        </select>  
                    </div>  

                    <div class="form-group">  
                        <select id="category" name="category" class="form-control">  
                            <option value="">Select Category</option>  
                            @foreach ($categories as $category)  
                                <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>  
                                    {{ $category->category_name }}  
                                </option>  
                            @endforeach  
                        </select>  
                    </div>  

                    <button type="submit" class="filter-button">Filter</button>  
                </form>  
            </div>

            <table class="invoice-table">
                <thead>  
                    <tr style="padding-bottom:5px;">
                        <th>Event</th>   
                        <th>Tenant</th>  
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
                            <td>{{ $invoice->event->name }}</td>
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
            <a href="{{ url('dashboard/') }}" class="back-button">Back</a>  
        </div>
    </div>
</body>
</html>