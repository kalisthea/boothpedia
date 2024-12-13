<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">
    <link rel="stylesheet" href="css/style-admin.css">
    <title>Detail Event</title>
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
            <!-- Banner -->  
            <img src="'images/evt-detail-1.png'" alt="" class="banner"> 

            <!-- Event Detail Content -->  
            <div class="detailevent-content">  
                <!-- Left box: Event Detail -->  
                <div class="box-event event-details">  
                    <p style="font-size:16px; padding-bottom:2px;">Nama Event</p>
                    <p style="font-size:24px; padding-bottom:15px;"><strong>Social Gathering</strong></p>  
                    <p style="font-size:16px; padding-bottom:2px;">Kategori Event</p>
                    <p style="font-size:24px; padding-bottom:15px;"><strong>Educational</strong></p>  
                    <p style="font-size:16px; padding-bottom:2px;">Lokasi</p>
                    <p style="font-size:24px; padding-bottom:15px;"><strong>Ciputat</strong></p>
                    <div class="event-date-container">
                        <div class="start-date">
                            <p style="font-size:16px; padding-bottom:2px;">Tanggal Mulai</p>
                            <p style="font-size:24px; padding-bottom:15px;"><strong>10-10-2024</strong></p>
                        </div>
                        <div class="end-date">
                            <p style="font-size:16px; padding-bottom:2px;">Tanggal Selesai</p>
                            <p style="font-size:24px; padding-bottom:15px;"><strong>10-10-2024</strong></p>
                        </div>                         
                    </div>
                    <div class="event-button-container" style="display: flex; justify-content: flex-end;">
                        <button class="edit-event-button">
                            <i class="fa-regular fa-pen-to-square"></i>Ubah Event
                        </button>
                        <button class="delete-event-button" style="margin-left: 10px;">
                            <i class="fa-solid fa-trash-can"></i>Hapus Event
                        </button>
                    </div> 
                     
                </div>  

                <!-- Right box: Event Description -->  
                <div class="box-event">  
                    <p><strong>Deskripsi</strong></p>
                    <p class="description">  
                        Ini adalah acara sosial yang diadakan untuk...  
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla accumsan, metus ultrices eu, tincidunt velit.  
                    </p>  
                    <div style="display: flex; justify-content: flex-end;">
                        <a href="{{route('mybooth')}}" class="booth-button" >Lihat Booth
                            <i class="fa-solid fa-arrow-right"></i>
                        </a>
                    </div>
                </div>  
            </div>
        </div>
    </div>
</body>
</html>