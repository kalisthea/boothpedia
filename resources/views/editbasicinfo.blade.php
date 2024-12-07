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
            <div class="info-container">
                <ul>
                    <li class="info-field">
                        <label for="eo-name-field">Nama Organizer</label>
                        <input type="text" name="eo-name" id="eo-name" required>
                    </li>
                    <li class="info-field">
                        <label for="eo-email-field">Email</label>
                        <input type="email" name="eo-email" id="eo-email" required>
                    </li>
                    <li class="info-field">
                        <label for="eo-phone-field">Nomor Ponsel</label>
                        <input type="text" name="eo-phone" id="eo-phone" required>
                    </li>
                </ul>
                <div class="button-info-container">
                    <a href="{{ route('info') }}" class="cancel-info">Batal</a>
                    <button type="submit" class="save-info">Simpan</button>
                </div>
            </div>
        </div>
    </div>
</body>
</html>