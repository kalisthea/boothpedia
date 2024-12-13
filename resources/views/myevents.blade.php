<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">
    <link rel="stylesheet" href="css/style-admin.css">
    <title>Event Saya</title>
</head>
<body>
    <!-- Side Bar -->
    @include('sidebar')

    <!-- Content -->
    <div class="container">
        <!-- Header -->
        <div class="header">
            <div class="header-name">
                <h1>Event Saya</h1>
            </div>
            @include('navheader')
        </div>
        <!-- My Event Content -->
        <div class="event-content">
            <div class="tab-events-header">
                <div class="tab-event active" onclick="showTab('tab1')">Event Aktif</div>  
                <div class="tab-event" onclick="showTab('tab2')">Event Lalu</div>  
            </div>
            <div class="tab-events-content">
                <div id="tab1" class="tab active">
                    <a href="{{route('eventdetail')}}">
                        <div class="card">
                            <img src="images/evt-1.png" alt="">
                            <div class="card-content">
                            <div class="content-top"> 
                                <b><p style="color:#FFC60B; margin-bottom:-1.5px;">MafSuzon</p></b>
                                <b><p style="color:#2FA8E8; margin-bottom:-1px;">Social Gathering</p></b>
                                <b><p style="color:#2FA8E8;">EO ABC</p></b>
                            </div>
                            <div class="content-bottom">
                                <p style="margin-bottom:-0.2px">12-02-2050 - 15-02-2050</p>
                                <p style="margin-bottom:-0.2px">Ciputat</p>
                                <p>Rp 100.000,00 - Rp 300.000,00</p>
                            </div>
                            </div>
                        </div>
                    </a>
                </div>  
                <div id="tab2" class="tab">
                    <a href="{{route('eventdetail')}}">
                        <div class="card">
                            <img src="images/evt-1.png" alt="">
                            <div class="card-content">
                            <div class="content-top"> 
                                <b><p style="color:#FFC60B; margin-bottom:-1.5px;">Event2</p></b>
                                <b><p style="color:#2FA8E8; margin-bottom:-1px;">Social Gathering</p></b>
                                <b><p style="color:#2FA8E8;">EO ABC</p></b>
                            </div>
                            <div class="content-bottom">
                                <p style="margin-bottom:-0.2px">12-02-2050 - 15-02-2050</p>
                                <p style="margin-bottom:-0.2px">Ciputat</p>
                                <p>Rp 100.000,00 - Rp 300.000,00</p>
                            </div>
                            </div>
                        </div>
                    </a>
                </div> 
            </div>
        </div>
    </div>

    <!-- Script -->
    <script>
        function showTab(tabName) {  
            // Hide all tabs  
            document.querySelectorAll('.tab').forEach(tab => {  
                tab.classList.remove('active');  
            });  
            // Remove active class from all tab events  
            document.querySelectorAll('.tab-event').forEach(event => {  
                event.classList.remove('active');  
            });  
            // Show the clicked tab and set it as active  
            document.getElementById(tabName).classList.add('active');  
            document.querySelector(`.tab-event[onclick="showTab('${tabName}')"]`).classList.add('active');  
        }
    </script>
</body>
</html>