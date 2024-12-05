<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">
    <link rel="stylesheet" href="css/style-admin.css">
    <title>Informasi Dasar</title>
</head>
<body>
        <!-- Side Bar -->
    @include('sidebar')

    <!-- Content -->
    <div class="container">
        <!-- Header -->
        <div class="header">
            <div class="header-name">
                <h1>Informasi Dasar</h1>
            </div>
            @include('navheader')
        </div>
        
        <!-- Edit Basic Information -->
        <div class="content">
            <div class="eo-image">
                <img src="" alt="Profile Picture">
                <button type="button" class="upload-profile-button">
                    <i class="fas fa-upload"></i> Upload Gambar
                    <input type="file">
                </button>
            </div>
            <div class="info-container">
                <ul>
                    <li class="info-field">
                        <div class="eo-name-title">Nama Organizer</div>
                        <div class="eo-name">Kenangan Organizer</div>
                    </li>
                    <li class="info-field">
                        <div class="eo-email-title">Email</div>
                        <div class="eo-email">adminkenangan@kenangan.co.id</div>
                    </li>
                    <li class="info-field">
                        <div class="eo-phone-title">Nomor Ponsel</div>
                        <div class="eo-phone">081234567890</div>
                    </li>
                    <li class="info-field">
                        <div class="eo-address-title">Alamat</div>
                        <div class="eo-address">Jl. Kenangan Karya No.11</div>
                    </li>
                    <li class="info-field">
                        <div class="eo-twitter-title">Username Twitter</div>
                        <div class="eo-twitter">@kenangan_eo</div>
                    </li>
                    <li class="info-field">
                        <div class="eo-ig-title">Username Instagram</div>
                        <div class="eo-ig">@kenangan_eo</div>
                    </li>
                </ul>
                <div class="button-info-container">
                    <button type="button">Batal</button>
                    <button type="submit">Simpan</button>
                </div>
            </div>
        </div>
    </div>
</body>
</html>