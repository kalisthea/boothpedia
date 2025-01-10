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
    <title>Ratings</title>
</head>
<body>
    <!-- Side Bar -->
    @include('sidebar')

    <!-- Content -->
    <div class="container">
        <!-- Header -->
        <div class="header">
            <div class="header-name">
                <h1>Ratings and Comments</h1>
            </div>
            @include('navheader')
        </div>

        <!-- Ratings and Comments -->
        <div class="booking-content" style="margin-bottom:70px">
            <div class="booth-detail">
                <div class="booth-detail-content">
                    <h2 style="margin-bottom:30px;"><strong>Average Rating : </strong>{{ number_format($averageRating, 1)}}/5</h2>
                </div>
            </div>

            <!-- Filter Section -->  
            <div class="filter-section">  
                <form method="GET" action="{{ route('ratings') }}" class="form-inline">  
                    <div class="form-group">  
                        <select id="rating" name="rating" class="form-control">  
                            <option value="">All Ratings</option>  
                            @for ($i = 1; $i <= 5; $i++)
                                <option value="{{ $i }}" {{ request('rating') == $i ? 'selected' : '' }}>
                                    {{ $i }}
                                </option>                        
                            @endfor
                        </select>  
                    </div>
                    <button type="submit" class="filter-button">Show</button>  
                </form>  
            </div>

            <table class="invoice-table">
                <thead>  
                    <tr style="padding-bottom:5px;">
                        <th>Event</th>   
                        <th>Tenant</th>  
                        <th>Rating</th>  
                        <th>Comment</th>  
                    </tr>  
                </thead>  
                <tbody>  
                    @foreach ($ratings as $rating)  
                        <tr>
                            <td>{{ $rating->event->name }}</td>
                            <td>{{ $rating->tenant->name}}</td> 
                            <td>{{ $rating->rating }}</td>
                            <td>{{ $rating->comment }}</td>
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