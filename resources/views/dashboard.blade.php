<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">
    <link rel="stylesheet" href="css/style-admin.css">
    <script src="{{ asset('script.js') }}"></script>
    <title>Boothpedia Admin</title>
</head>
<body>
    <!-- Side Bar -->
    @include('sidebar')

    <!-- Content -->
    <div class="container">
        <!-- Header -->
        <div class="header">
            <div class="header-name">
                <h1>Dashboard</h1>
            </div>
            @include('navheader')
        </div>

        <!-- Dashboard Content -->
        <div class="content">
            <div class="overview-boxes">
                <div class="dash-row">
                    <div class="box">
                        <div class="left-side">
                            <div class="box-topic">Active Events</div>
                            <div class="number">{{ $totalActiveEvents }}</div>
                        </div>
                    </div>
                    <div class="box">
                        <div class="left-side">
                            <div class="box-topic">Past Events</div>
                            <div class="number">{{ $totalPastEvents }}</div>
                        </div>
                    </div>
                    <div class="box">
                        <div class="left-side">
                            <div class="box-topic">Rating</div>
                            <div class="number">{{ number_format($averageRating, 1)}}/5</div>
                        </div>
                    </div>
                </div>
                <div class="dash-row">
                <div class="box">
                        <div class="left-side">
                            <div class="box-topic">Active Booths</div>
                            <div class="number">{{ $totalActiveBooths }}</div>
                        </div>
                    </div>
                    <div class="box">
                        <div class="left-side">
                            <div class="box-topic">Total Sales</div>
                            <div class="number">Rp {{ number_format($totalSales, 2, ',', '.') }}</div>
                        </div>
                    </div>
                    <div class="box">
                        <div class="left-side">
                            <div class="box-topic">Total Booths Sold</div>
                            <div class="number">{{ $totalBoothsSold }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Check for success message -->  
    @if(session('success'))  
        <div id="sessionMessage" style="display: none;">{{ session('success') }}</div>  
        <div id="successModal" class="modal">  
            <div class="modal-content">  
                <span class="checkmark">
                    <i class="fa-solid fa-check"></i>
                </span> 
                <h5 id="modalMessage"></h5>
                <button id="closeModal" class="close-button">OK</button>  
            </div>  
        </div>  
    @endif
</body>
</html>