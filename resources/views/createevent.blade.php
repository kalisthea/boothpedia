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
    <div class="form-event-container">
        <ul>
            <li class="event-name">
                <label for="title">Nama Event</label>
                <input type="text" name="event-name" id="event-name" required>
            </li>
            <li class="event-category">
                <label for="event-category">Kategori Event</label>
                <input type="text" name="event-category" id="event-category" required>
            </li>
            <div class="date-container">
                <li class="date-field">
                    <label for="start-date">Tanggal Mulai</label>
                    <div class="input-date-wrapper">
                        <input type="text" name="start-date" id="start-date" required>
                        <span class="calendar-icon"><i class="fa-regular fa-calendar"></i></span>
                    </div>
                </li>
                <li class="date-field">
                    <label for="finish-date">Tanggal Berakhir</label>
                    <div class="input-date-wrapper">
                        <input type="text" name="finish-date" id="finish-date" required>
                        <span class="calendar-icon"><i class="fa-regular fa-calendar"></i></span>
                    </div>
                </li>
            </div>
            <li class="location">
                <label for="location">Lokasi</label>
                <input type="text" name="location" id="location" required>
            </li>
            <li class="desc">
                <label for="desc">Deskripsi</label>
                <input type="text" name="desc" id="desc" required>
            </li>
            <li class="button-container">
                <button type="button" class="cancel-button" name="cancel">Batal</button>
                <button type="submit" class="submit-button" name="submit">Simpan</button>
            </li>
        </ul>
    </div> 
</body>
</html>