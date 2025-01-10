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
                            <div class="box-top">
                                <div class="box-topic" style="margin-right:41px;">Active Events</div>
                                <a href="{{ route('events') }}" style="color:#006AA6; font-size:smaller;">See Details
                                    <i class="fa-solid fa-arrow-right"></i>
                                </a>
                            </div>
                            <div class="number">{{ $totalActiveEvents }}</div>
                        </div>
                    </div>
                    <div class="box">
                        <div class="left-side">
                            <div class="box-top">
                                <div class="box-topic" style="margin-right:61px;">Past Events</div>
                                <a href="{{ route('events') }}" style="color:#006AA6; font-size:smaller;">See Details
                                    <i class="fa-solid fa-arrow-right"></i>
                                </a>
                            </div>
                            <div class="number">{{ $totalPastEvents }}</div>
                        </div>
                    </div>
                    <div class="box">
                        <div class="left-side">
                            <div class="box-topic">Active Booths</div>
                            <div class="number">{{ $totalActiveBooths }}</div>
                        </div>
                    </div>
                </div>
                <div class="dash-row">
                    <div class="box">
                        <div class="left-side">
                            <div class="box-top">
                                <div class="box-topic" style="margin-right:115px;">Rating</div>
                                <a href="{{ route('ratings') }}" style="color:#006AA6; font-size:smaller;">See Details
                                    <i class="fa-solid fa-arrow-right"></i>
                                </a>
                            </div>
                            <div class="number">{{ number_format($averageRating, 1)}}/5</div>
                        </div>
                    </div>
                    <div class="box">
                        <div class="left-side">
                            <div class="box-top">
                                <div class="box-topic" style="margin-right:69px;">Total Sales</div>
                                <a href="{{ route('invoice') }}" style="color:#006AA6; font-size:smaller;">See Details
                                    <i class="fa-solid fa-arrow-right"></i>
                                </a>
                            </div>
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
</body>
</html>