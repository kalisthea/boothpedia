<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">
    <link rel="stylesheet" href="css/style-admin.css">
    <title>Buat Event</title>
</head>
<body>
    <header>
        <img src="images/Logo.png" alt="" class="logo">
        <h1>Buat Event</h1>
    </header>
    <form class="create-event-container" id="eventForm" method="POST" enctype="multipart/form-data" action="{{ route('events.store') }}">
        @csrf  
        <div class="upload-image">
            <button type="button" class="upload-img-button">
                <i class="fas fa-upload"></i> Upload Gambar
                <input type="file" id="banner_photo" name="banner_photo" accept="image/*">
            </button>
        </div>
        <ul>
            <li class="event-name">
                <label for="name">Nama Event</label>
                <input type="text" name="name" id="name" placeholder="Input nama event..." required>
            </li>
            <li class="event-category">
                <label for="category">Kategori Event</label>
                <select name="category" id="category" required>  
                    <option hidden>Pilih kategori...</option>
                    <option value="Education">Education</option>
                    <option value="Fashion & Beauty">Fashion & Beauty</option>
                    <option value="Hobbies & Crafts">Hobbies & Crafts</option>
                    <option value="Music">Music</option>
                    <option value="Food & Drinks">Food & Drinks</option>
                    <option value="Art & Culture">Art & Culture</option>
                    <option value="Tech & Start Up">Tech & Start Up</option>
                    <option value="Travel & Vacation">Travel & Vacation</option>
                </select>
            </li>
            <div class="date-container">
                <li class="date-field">
                    <label for="start_date">Tanggal Mulai</label>
                    <div class="input-date-wrapper">
                        <input type="date" name="start_date" id="start_date" required>
                    </div>
                </li>
                <li class="date-field">
                    <label for="end_date">Tanggal Berakhir</label>
                    <div class="input-date-wrapper">
                        <input type="date" name="end_date" id="end_date" required>
                    </div>
                </li>
            </div>
            <li class="location">
                <label for="location">Lokasi</label>
                <input type="text" name="location" id="location" placeholder="Input lokasi..." required>
            </li>
            <li class="venue">
                <label for="venue">Venue</label>
                <input type="text" name="venue" id="venue" placeholder="Input venue..." required>
            </li>
            <li class="desc">
                <label for="description">Deskripsi</label>
                <input type="text" name="description" id="description" placeholder="Input deskripsi..." required>
            </li>
            <li class="button-container">
                <a href="{{route('dashboard')}}">
                    <button type="button" class="cancel-button" name="cancel">Batal</button>
                </a>
                <input type="submit" class="submit-button" value="Simpan">
            </li>
        </ul>
    </form> 
    @if ($errors->any())  
    <div class="alert alert-danger">  
        <ul>  
            @foreach ($errors->all() as $error)  
                <li>{{ $error }}</li>  
            @endforeach  
        </ul>  
    </div>  
@endif
</body>
</html>