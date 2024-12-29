<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">
    <link rel="stylesheet" href="css/style-admin.css">
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
                <div class="box">
                    <div class="left-side">
                        <div class="box-topic">Event Aktif</div>
                        <div class="number">5</div>
                    </div>
                </div>
                <div class="box">
                    <div class="left-side">
                        <div class="box-topic">Event Lalu</div>
                        <div class="number">28</div>
                    </div>
                </div>
                <div class="box">
                    <div class="left-side">
                        <div class="box-topic">Rating</div>
                        <div class="number">4.9/5</div>
                    </div>
                </div>
                <div class="box">
                    <div class="left-side">
                        <div class="box-topic">Booth Aktif</div>
                        <div class="number">37</div>
                    </div>
                </div>
                <div class="box">
                    <div class="left-side">
                        <div class="box-topic">Total Penjualan</div>
                        <div class="number">Rp 123.456.789</div>
                    </div>
                </div>
                <div class="box">
                    <div class="left-side">
                        <div class="box-topic">Total Booth Terjual</div>
                        <div class="number">120</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>